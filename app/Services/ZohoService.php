<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ZohoService
{
    /* =========================
     * AUTH
     * ========================= */
    protected function getAccessToken(): string
    {
        $accountsUrl = rtrim(config('zoho.auth.accounts_url', 'https://accounts.zohocloud.ca'), '/');

        $response = Http::asForm()->post($accountsUrl . '/oauth/v2/token', [
            'refresh_token' => config('zoho.auth.refresh_token'),
            'client_id'     => config('zoho.auth.client_id'),
            'client_secret' => config('zoho.auth.client_secret'),
            'grant_type'    => 'refresh_token',
        ]);

        if ($response->failed()) {
            throw new \RuntimeException('Zoho Auth Error: ' . $response->status() . ' ' . $response->body());
        }

        $json = $response->json();
        if (empty($json['access_token'])) {
            throw new \RuntimeException('Zoho Auth Error: missing access_token. Body: ' . $response->body());
        }

        return $json['access_token'];
    }

    /* =========================
     * ENDPOINTS
     * ========================= */
    protected function peopleRecordsUrl(): string
    {
        $base = rtrim(config('zoho.people.base_url', 'https://people.zohocloud.ca'), '/');
        $path = config('zoho.people.records_path', '/people/api/forms/employee/getRecords');

        // garantit un seul /
        return $base . '/' . ltrim($path, '/');
    }

    /* =========================
     * FETCH USERS (raw)
     * ========================= */
    public function fetchUsers(): array
    {
        $token = $this->getAccessToken();
        $url   = $this->peopleRecordsUrl();

        $pageSize = (int) config('zoho.people.page_size', 200);
        $maxPages = (int) config('zoho.people.max_pages', 50);

        $all = [];
        $sIndex = 1;

        for ($page = 1; $page <= $maxPages; $page++) {
            $response = Http::withHeaders([
                'Authorization' => 'Zoho-oauthtoken ' . $token,
                'Accept'        => 'application/json',
            ])->get($url, [
                'sIndex' => $sIndex,
                'limit'  => $pageSize,
            ]);

            // wrong endpoint -> HTML
            $contentType = (string) $response->header('Content-Type');
            if ($contentType && str_contains($contentType, 'text/html')) {
                throw new \RuntimeException("Zoho API returned HTML (wrong endpoint). URL={$url} Status={$response->status()}");
            }

            if ($response->failed()) {
                throw new \RuntimeException('Zoho API Error: ' . $response->status() . ' ' . $response->body());
            }

            $json = $response->json();
            if (!is_array($json)) {
                throw new \RuntimeException('Zoho API Error: non-JSON response. Status=' . $response->status());
            }

            // erreurs logiques Zoho
            if (isset($json['response']['errors'])) {
                $err = $json['response']['errors'];

                // 7024 = No records found (fin ou vide)
                if (($err['code'] ?? null) == 7024) {
                    break;
                }

                throw new \RuntimeException('Zoho Logic Error: ' . json_encode($err));
            }

            $records = $json['response']['result'] ?? [];
            if (!is_array($records) || empty($records)) {
                break;
            }

            foreach ($records as $r) {
                if (is_array($r)) $all[] = $r;
            }

            if (count($records) < $pageSize) {
                break;
            }

            $sIndex += $pageSize;
        }

        return $all;
    }

    /* =========================
     * SYNC
     * ========================= */
    public function syncUsers(): int
    {
        $raw = $this->fetchUsers();

        if (empty($raw)) {
            Log::warning('Zoho People sync: 0 fetched records.');
            return 0;
        }

        $synced = 0;
        $skipped = 0;

        foreach ($raw as $item) {
            $record = $this->flattenZohoRecord($item);

            if (!$record) {
                $skipped++;
                continue;
            }

            $normalized = $this->normalizeUser($record);

            // On exige un id stable + email (au minimum)
            if (empty($normalized['zoho_id']) || empty($normalized['email'])) {
                $skipped++;
                continue;
            }

            // ✅ email unique : si un employé existe déjà avec cet email, on réutilise sa ligne
            $existingByEmail = Employee::where('email', $normalized['email'])->first();

            if ($existingByEmail && $existingByEmail->zoho_id !== $normalized['zoho_id']) {
                // on met à jour la ligne existante
                $existingByEmail->update($normalized);
                $synced++;
                continue;
            }

            // ✅ Upsert stable sur zoho_id
            Employee::updateOrCreate(
                ['zoho_id' => $normalized['zoho_id']],
                $normalized
            );

            $synced++;
        }

        Log::info('Zoho People sync summary', [
            'fetched'  => count($raw),
            'synced'   => $synced,
            'skipped'  => $skipped,
        ]);

        return $synced;
    }

    /**
     * Zoho returns records wrapped like:
     * [ Zoho_ID => [ 0 => [fields...] ] ]
     * This extracts the inner fields array.
     */
    private function flattenZohoRecord(array $item): ?array
    {
        $first = reset($item);
        if (!is_array($first)) return null;

        $record = $first[0] ?? null;
        if (!is_array($record)) return null;

        return $record;
    }

    /* =========================
     * NORMALIZE
     * ========================= */
    private function normalizeUser(array $user): array
    {
        // ID stable (gros number)
        $zohoId = $user['Zoho_ID'] ?? $user['ZohoID'] ?? null;

        // ton code interne
        $employeeNumber = $user['EmployeeID'] ?? null;

        $email = $user['EmailID']
            ?? $user['Email_ID']
            ?? $user['Email']
            ?? $user['Work_Email']
            ?? null;

        $first = $user['FirstName'] ?? $user['First_Name'] ?? '';
        $last  = $user['LastName']  ?? $user['Last_Name']  ?? '';

        $name = trim($first . ' ' . $last);
        if ($name === '') {
            $name = $user['Name'] ?? null;
        }

        return [
            'zoho_id'          => $zohoId,
            'employee_number'  => $employeeNumber,
            'name'             => $name,
            'email'            => $email,
            'role'             => $user['Designation'] ?? $user['Role'] ?? 'Employé',
            'status'           => $user['Employeestatus'] ?? $user['Employee_Status'] ?? 'Active',


            // ✅ tout le dossier complet
            'zoho_payload'      => $user,
        ];
    }
}

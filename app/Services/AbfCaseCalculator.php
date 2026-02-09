<?php

namespace App\Services;

class AbfCaseCalculator
{
    public function calculate(array $payload): array
    {
        $payload = $payload ?: [];

        $totals = $this->totals($payload);
        $progress = $this->progress($payload);

        return [
            'totals' => $totals,
            'progress' => $progress,
            'meta' => [
                'computed_at' => now()->toIso8601String(),
            ],
        ];
    }

    private function totals(array $payload): array
    {
        $assets = (array) ($payload['assets'] ?? []);
        $liabs  = (array) ($payload['liabilities'] ?? []);

        $assetsTotal = 0.0;
        foreach ($assets as $a) {
            $assetsTotal += (float) ($a['value'] ?? 0);
        }

        $liabsTotal = 0.0;
        foreach ($liabs as $l) {
            $liabsTotal += (float) ($l['balance'] ?? 0);
        }

        return [
            'assets_total' => round($assetsTotal, 2),
            'liabilities_total' => round($liabsTotal, 2),
            'net_worth' => round($assetsTotal - $liabsTotal, 2),
        ];
    }

    private function progress(array $payload): array
    {
        // Les "sections" correspondent à tes steps Wizard
        $checks = [
            'dossier' => fn() => true, // toujours OK (statut & conseiller géré ailleurs)
            'client' => fn() => $this->hasText($payload, 'client.first_name') && $this->hasText($payload, 'client.last_name'),
            'conjoint' => fn() => $this->spouseOk($payload),
            'famille' => fn() => $this->repeaterItemsOk($payload['dependents'] ?? [], ['name']),
            'actifs' => fn() => $this->repeaterItemsOk($payload['assets'] ?? [], ['type', 'value']),
            'passifs' => fn() => $this->repeaterItemsOk($payload['liabilities'] ?? [], ['type', 'balance']),
            'protections' => fn() => $this->repeaterItemsOk($payload['insurances'] ?? [], ['type', 'insured']),
            'resume' => fn() => true,
        ];

        $done = [];
        foreach ($checks as $key => $fn) {
            $done[$key] = (bool) $fn();
        }

        $total = count($done);
        $countDone = count(array_filter($done));
        $percent = $total > 0 ? (int) round(($countDone / $total) * 100) : 0;

        return [
            'percent' => $percent,
            'sections' => $done,
            'done' => $countDone,
            'total' => $total,
        ];
    }

    private function spouseOk(array $payload): bool
    {
        $hasSpouse = (bool) ($payload['has_spouse'] ?? false);

        if (! $hasSpouse) {
            return true;
        }

        return $this->hasText($payload, 'spouse.first_name')
            && $this->hasText($payload, 'spouse.last_name');
    }

    private function repeaterItemsOk(array $items, array $requiredKeys): bool
    {
        // Si aucune ligne : on considère OK (sinon ça bloque 100% pour les gens sans actifs, etc.)
        if (count($items) === 0) {
            return true;
        }

        foreach ($items as $item) {
            foreach ($requiredKeys as $key) {
                if (!isset($item[$key]) || $item[$key] === '' || $item[$key] === null) {
                    return false;
                }
            }
        }

        return true;
    }

    private function hasText(array $payload, string $path): bool
    {
        $value = data_get($payload, $path);
        return is_string($value) && trim($value) !== '';
    }
}

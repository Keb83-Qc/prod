<?php

namespace App\Filament\Resources\PartnerResource\Pages;

use App\Filament\Resources\PartnerResource;
use App\Models\Partner;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreatePartner extends CreateRecord
{
    protected static string $resource = PartnerResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label('Sauvegarder'),
            $this->getCreateAnotherFormAction()->label('Sauvegarder et créer un autre'),
            Actions\Action::make('cancel')->label('Annuler')->url($this->getResource()::getUrl('index'))->color('gray'),
        ];
    }

    protected function handleRecordCreation(array $data): Model
    {
        // Initialize paths
        $finalPathFr = null;
        $finalPathEn = null;

        // Handle French Logo
        if (!empty($data['logo_fr'])) {
            $finalPathFr = $this->processLogo($data['logo_fr'], $data['name'], 'fr');
        }

        // Handle English Logo
        if (!empty($data['logo_en'])) {
            $finalPathEn = $this->processLogo($data['logo_en'], $data['name'], 'en');
        }

        // Create the partner record
        $partner = Partner::create([
            'name' => $data['name'],
            'logo_fr' => $finalPathFr,
            'logo_en' => $finalPathEn,
            'website' => $data['website'] ?? null,
            'is_visible' => $data['is_visible'] ?? true,
            'sort_order' => Partner::max('sort_order') + 1,
        ]);

        return $partner;
    }

    /**
     * Helper function to rename and move the logo
     */
    protected function processLogo($logoPath, $name, $lang)
    {
        // If it's an array (multiple files uploaded), take the first one
        // Filament's FileUpload can return an array even for single files
        if (is_array($logoPath)) {
            $logoPath = reset($logoPath);
        }

        $slug = Str::slug($name);
        $extension = pathinfo($logoPath, PATHINFO_EXTENSION);

        // Create new unique name: banque-royale-fr-1738493.jpg
        $newFilename = $slug . '-' . $lang . '-' . time() . '.' . $extension;
        $newPath = 'partners/' . $newFilename;

        if (Storage::disk('public')->exists($logoPath)) {
            Storage::disk('public')->move($logoPath, $newPath);
            return $newPath;
        }

        return $logoPath;
    }
}
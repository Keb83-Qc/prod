<?php

namespace App\Filament\Concerns;

trait AbfFullWidthPage
{
    /**
     * ✅ ABF seulement: ajoute une classe sur le <body>
     */
    public function getExtraBodyAttributes(): array
    {
        $attributes = parent::getExtraBodyAttributes();

        $existingClass = $attributes['class'] ?? '';

        $attributes['class'] = trim($existingClass . ' abf-fullwidth');

        return $attributes;
    }

    /**
     * ✅ ABF seulement: largeur de contenu "full"
     */
    public function getMaxContentWidth(): ?string
    {
        return 'full';
    }
}

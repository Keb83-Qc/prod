<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChatStep;

class ChatStepsSeeder extends Seeder
{
    public function run()
    {
        $steps = [
            [
                'identifier' => 'vehicle_year',
                'question' => 'Quelle est l\'année de votre véhicule ?',
                'input_type' => 'select',
                'sort_order' => 10,
            ],
            [
                'identifier' => 'vehicle_brand_name',
                'question' => 'Quelle est la marque de votre véhicule ?',
                'input_type' => 'select', // On gérera la logique spéciale dans le composant
                'sort_order' => 20,
            ],
            [
                'identifier' => 'vehicle_model_name',
                'question' => 'Et le modèle ?',
                'input_type' => 'select',
                'sort_order' => 30,
            ],
            [
                'identifier' => 'usage_type',
                'question' => 'Est-ce pour un usage personnel ou commercial ?',
                'input_type' => 'buttons',
                'options' => [
                    ['label' => 'Personnel', 'value' => 'Personnel'],
                    ['label' => 'Commercial', 'value' => 'Commercial'],
                ],
                'sort_order' => 40,
            ],
            [
                'identifier' => 'commute_days',
                'question' => 'Combien de jours par semaine utilisez-vous le véhicule pour le travail ?',
                'input_type' => 'select',
                'sort_order' => 50,
            ],
            [
                'identifier' => 'annual_km',
                'question' => 'Quel est votre kilométrage annuel estimé ?',
                'input_type' => 'select',
                'options' => [
                    ['label' => '0 - 15 000 km', 'value' => '0-15000'],
                    ['label' => '15 000 - 20 000 km', 'value' => '15000-20000'],
                    ['label' => '20 000 km +', 'value' => '20000+'],
                ],
                'sort_order' => 60,
            ],
            [
                'identifier' => 'gender',
                'question' => 'Votre genre ?',
                'input_type' => 'buttons',
                'options' => [
                    ['label' => 'Homme', 'value' => 'Homme'],
                    ['label' => 'Femme', 'value' => 'Femme'],
                ],
                'sort_order' => 70,
            ],
            [
                'identifier' => 'dob',
                'question' => 'Quelle est votre date de naissance ?',
                'input_type' => 'date',
                'sort_order' => 80,
            ],
            [
                'identifier' => 'address',
                'question' => 'Quelle est votre adresse complète ?',
                'input_type' => 'text',
                'sort_order' => 90,
            ],
            [
                'identifier' => 'marital_status',
                'question' => 'Quel est votre état civil ?',
                'input_type' => 'select',
                'options' => [
                    ['label' => 'Célibataire', 'value' => 'Célibataire'],
                    ['label' => 'Marié(e)', 'value' => 'Marié'],
                    ['label' => 'Conjoint de fait', 'value' => 'Conjoint de fait'],
                ],
                'sort_order' => 100,
            ],
            [
                'identifier' => 'email',
                'question' => 'Quelle est votre adresse courriel ?',
                'input_type' => 'text',
                'sort_order' => 110,
            ],
            [
                'identifier' => 'phone',
                'question' => 'Votre numéro de téléphone ?',
                'input_type' => 'text',
                'sort_order' => 120,
            ],
        ];

        foreach ($steps as $step) {
            ChatStep::updateOrCreate(['identifier' => $step['identifier']], $step);
        }
    }
}

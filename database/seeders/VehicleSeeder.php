<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleBrand;
use App\Models\VehicleModel;

class VehicleSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            'Toyota' => ['Corolla', 'RAV4', 'Camry', 'Prius', 'Highlander'],
            'Honda' => ['Civic', 'CR-V', 'Accord', 'Pilot', 'HR-V'],
            'Hyundai' => ['Elantra', 'Tucson', 'Santa Fe', 'Kona'],
            'Ford' => ['F-150', 'Mustang', 'Escape', 'Explorer'],
            'Mazda' => ['Mazda3', 'CX-5', 'CX-30', 'MX-5'],
            'Kia' => ['Forte', 'Sportage', 'Sorento', 'Soul'],
            'Nissan' => ['Sentra', 'Rogue', 'Altima', 'Kicks'],
            'Chevrolet' => ['Silverado', 'Equinox', 'Malibu'],
            'BMW' => ['Série 3', 'X3', 'X5'],
            'Mercedes-Benz' => ['Classe C', 'GLC', 'Classe A'],
            'Audi' => ['A3', 'A4', 'Q3', 'Q5'],
            'Volkswagen' => ['Jetta', 'Golf', 'Tiguan'],
        ];

        foreach ($brands as $brandName => $models) {
            $brand = VehicleBrand::create(['name' => $brandName]);
            foreach ($models as $modelName) {
                VehicleModel::create([
                    'vehicle_brand_id' => $brand->id,
                    'name' => $modelName
                ]);
            }
        }
    }
}

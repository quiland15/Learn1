<?php

namespace Database\Seeders;

use App\Models\WastePrice;
use Illuminate\Database\Seeder;

class WastePriceSeeder extends Seeder
{
    public function run(): void
    {
        $prices = [
            ['category' => 'plastic', 'name' => 'Botol PET Bersih', 'price_per_kg' => 3500],
            ['category' => 'plastic', 'name' => 'Ember Plastik', 'price_per_kg' => 2000],
            ['category' => 'plastic', 'name' => 'Plastik HDPE', 'price_per_kg' => 2500],
            ['category' => 'plastic', 'name' => 'Gelas Plastik PP', 'price_per_kg' => 1500],
            ['category' => 'glass', 'name' => 'Kaca Botol', 'price_per_kg' => 500],
            ['category' => 'glass', 'name' => 'Kaca Pecah', 'price_per_kg' => 300],
            ['category' => 'cans', 'name' => 'Kaleng Aluminium', 'price_per_kg' => 12000],
            ['category' => 'cans', 'name' => 'Kaleng Baja', 'price_per_kg' => 3000],
            ['category' => 'cans', 'name' => 'Kaleng Aerosol', 'price_per_kg' => 2500],
        ];

        foreach ($prices as $p) {
            WastePrice::updateOrCreate(
                ['category' => $p['category'], 'name' => $p['name']],
                ['price_per_kg' => $p['price_per_kg']]
            );
        }
    }
}

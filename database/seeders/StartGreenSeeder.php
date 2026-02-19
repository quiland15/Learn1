<?php

namespace Database\Seeders;

use App\Models\PickupRequest;
use App\Models\User;
use App\Models\WastePrice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StartGreenSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(WastePriceSeeder::class);

        $admin = User::updateOrCreate(
            ['email' => 'admin@startgreen.id'],
            [
                'name' => 'Admin Agape',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'balance' => 0,
            ]
        );

        $nasabahList = [];
        for ($i = 1; $i <= 10; $i++) {
            $nasabahList[] = User::updateOrCreate(
                ['email' => "nasabah{$i}@example.com"],
                [
                    'name' => "Nasabah {$i}",
                    'password' => Hash::make('password'),
                    'role' => 'nasabah',
                    'balance' => $i * 50000,
                ]
            );
        }

        $categories = [
            'plastic' => 'Plastik',
            'glass' => 'Kaca',
            'cans' => 'Kaleng',
        ];

        $priceByCategory = [
            'plastic' => 2500,
            'glass' => 400,
            'cans' => 5000,
        ];
        $getPrice = function ($cat) use ($priceByCategory) {
            return $priceByCategory[$cat] ?? 3000;
        };

        $pickups = [
            ['user' => $nasabahList[0], 'cat' => 'plastic', 'est_kg' => 5, 'act_kg' => null, 'status' => 'pending', 'scheduled_at' => now()->addDays(1)],
            ['user' => $nasabahList[1], 'cat' => 'cans', 'est_kg' => 3, 'act_kg' => null, 'status' => 'pending', 'scheduled_at' => now()->addDays(2)],
            ['user' => $nasabahList[2], 'cat' => 'plastic', 'est_kg' => 4, 'act_kg' => 4.2, 'status' => 'completed', 'scheduled_at' => now()->subDays(3)],
            ['user' => $nasabahList[3], 'cat' => 'glass', 'est_kg' => 2, 'act_kg' => 2, 'status' => 'completed', 'scheduled_at' => now()->subDays(5)],
            ['user' => $nasabahList[4], 'cat' => 'cans', 'est_kg' => 6, 'act_kg' => 5.5, 'status' => 'completed', 'scheduled_at' => now()->subDays(7)],
        ];

        foreach ($pickups as $i => $p) {
            $pricePerKg = $getPrice($p['cat']);
            $estPrice = round($p['est_kg'] * $pricePerKg, 0);
            $finalPrice = $p['act_kg'] !== null ? round($p['act_kg'] * $pricePerKg, 0) : null;
            PickupRequest::updateOrCreate(
                [
                    'user_id' => $p['user']->id,
                    'scheduled_at' => $p['scheduled_at'],
                    'category' => $p['cat'],
                ],
                [
                    'category_label' => $categories[$p['cat']],
                    'estimated_weight_kg' => $p['est_kg'],
                    'actual_weight_kg' => $p['act_kg'],
                    'estimated_price' => $estPrice,
                    'final_price' => $finalPrice,
                    'lat' => -6.2 + ($i * 0.01),
                    'lng' => 106.8 + ($i * 0.01),
                    'address' => "Alamat Nasabah {$p['user']->name}",
                    'status' => $p['status'],
                    'admin_verified_at' => $p['status'] === 'completed' ? now()->subDays($i) : null,
                    'verified_by' => $p['status'] === 'completed' ? $admin->id : null,
                ]
            );
        }
    }
}

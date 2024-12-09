<?php

namespace Database\Seeders;

use App\Models\OtherExpense;
use App\Models\Prostoy;
use App\Models\Reason;
use App\Models\Supplier;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(200)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $faker = Faker::create();
        for ($i = 0; $i < 100; $i++) {
            Prostoy::create([
                'order_id' => rand(1, 200), // Tasodifiy order_id (uuid)
                'client_id' => rand(1, 200), // Tasodifiy client_id
                'carrier_id' => rand(1, 200), // Tasodifiy carrier_id
                'sales_id' => rand(1, 200), // Tasodifiy sales_id
                'operation_id' => rand(1, 200),
                'carrier_amount' => $faker->randomFloat(2, 100, 10000), // Tasodifiy carrier_amount
                'carrier_currency' => $faker->randomElement(['uzs', 'usd', 'eur', 'rub']), // Tasodifiy carrier_currency
                'client_amount' => $faker->randomFloat(2, 100, 10000), // Tasodifiy client_amount
                'client_currency' => $faker->randomElement(['uzs', 'usd', 'eur', 'rub']), // Tasodifiy client_currency
            ]);
        }
        for ($i = 0; $i <= 10; $i++) {
            Supplier::create([
                'name' => $faker->company,
            ]);
        }
        for ($i = 0; $i <= 5; $i++) {
            Reason::create([
                'name' => $faker->word,
            ]);
        }
        for ($i=0; $i < 50; $i++) { 
            OtherExpense::create([
                'order_id' => rand(1, 10),
                'supplier_id' => rand(1, 10),
                'reason_id' => rand(1, 5),
                'currency' => $faker->randomElement(['uzs', 'usd', 'eur', 'rub']),
                'amount' => $faker->randomFloat(2, 100, 10000),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'id' => TransactionType::FUEL_DISPENSED,
                'name' => 'Fuel Dispensed',
            ],
            [
                'id' => TransactionType::FUEL_ADJUSTMENT,
                'name' => 'Fuel Adjustment',
            ],
            [
                'id' => TransactionType::FUEL_DIP,
                'name' => 'Fuel Dip',
            ],
            [
                'id' => TransactionType::FUEL_DROP,
                'name' => 'Fuel Drop',
            ],
            [
                'id' => TransactionType::FUEL_TRANSFER,
                'name' => 'Fuel Transfer',
            ]
        ])->each(fn (array $transactionType) => TransactionType::updateOrCreate($transactionType));
    }
}

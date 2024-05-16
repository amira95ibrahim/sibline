<?php

namespace Database\Seeders;

use App\Models\WalletTransaction;
use Illuminate\Database\Seeder;

class WalletTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WalletTransaction::factory()->count(5)->create();
    }
}

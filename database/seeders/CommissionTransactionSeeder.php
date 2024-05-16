<?php

namespace Database\Seeders;

use App\Models\CommissionTransaction;
use Illuminate\Database\Seeder;

class CommissionTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CommissionTransaction::factory()->count(5)->create();
    }
}

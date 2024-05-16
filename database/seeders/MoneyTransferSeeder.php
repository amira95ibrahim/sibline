<?php

namespace Database\Seeders;

use App\Models\MoneyTransfer;
use Illuminate\Database\Seeder;

class MoneyTransferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MoneyTransfer::factory()->count(5)->create();
    }
}

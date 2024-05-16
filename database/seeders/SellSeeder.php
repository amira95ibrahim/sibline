<?php

namespace Database\Seeders;

use App\Models\Sell;
use Illuminate\Database\Seeder;

class SellSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sell::factory()->count(5)->create();
    }
}

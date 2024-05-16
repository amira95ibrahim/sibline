<?php

namespace Database\Seeders;

use App\Models\RentContract;
use Illuminate\Database\Seeder;

class RentContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RentContract::factory()->count(5)->create();
    }
}

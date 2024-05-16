<?php

namespace Database\Seeders;

use App\Models\RevenueCustomer;
use Illuminate\Database\Seeder;

class RevenueCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RevenueCustomer::factory()->count(5)->create();
    }
}

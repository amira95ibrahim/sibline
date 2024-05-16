<?php

namespace Database\Seeders;

use App\Models\CustomerContact;
use Illuminate\Database\Seeder;

class CustomerContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomerContact::factory()->count(5)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\PartnerContact;
use Illuminate\Database\Seeder;

class PartnerContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PartnerContact::factory()->count(5)->create();
    }
}

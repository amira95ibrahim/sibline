<?php

namespace Database\Seeders;

use App\Models\CommissionSetting;
use Illuminate\Database\Seeder;

class CommissionSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CommissionSetting::factory()->count(5)->create();
    }
}

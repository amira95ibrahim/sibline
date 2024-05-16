<?php

namespace Database\Seeders;

use App\Models\Photo ;
use Illuminate\Database\Seeder;

class Photo Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Photo ::factory()->count(5)->create();
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Share;

class ShareFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Share::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'percentage' => $this->faker->numberBetween(-10000, 10000),
            'amount' => $this->faker->numberBetween(-10000, 10000),
            'status' => $this->faker->randomElement(["0","1"]),
        ];
    }
}

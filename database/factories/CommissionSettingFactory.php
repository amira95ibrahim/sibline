<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CommissionSetting;

class CommissionSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommissionSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'wallet_in' => $this->faker->numberBetween(-10000, 10000),
            'wallet_out' => $this->faker->numberBetween(-10000, 10000),
            'shares_buying' => $this->faker->numberBetween(-10000, 10000),
            'shares_selling' => $this->faker->numberBetween(-10000, 10000),
            'type' => $this->faker->randomElement(["BROKER",""]),
        ];
    }
}

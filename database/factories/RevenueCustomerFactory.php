<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Revenue;
use App\Models\RevenueCustomer;

class RevenueCustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RevenueCustomer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'amount' => $this->faker->numberBetween(-10000, 10000),
            'percentage' => $this->faker->randomFloat(0, 0, 9999999999.),
            'commission' => $this->faker->randomFloat(0, 0, 9999999999.),
            'date' => $this->faker->date(),
            'revenue_id' => Revenue::factory(),
        ];
    }
}

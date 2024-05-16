<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Models\Property;
use App\Models\Sell;

class SellFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sell::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),
            'property_id' => Property::factory(),
            'percentage' => $this->faker->randomFloat(0, 0, 9999999999.),
            'amount' => $this->faker->numberBetween(-10000, 10000),
            'status' => $this->faker->randomElement(["PENDING","APPROVED"]),
        ];
    }
}

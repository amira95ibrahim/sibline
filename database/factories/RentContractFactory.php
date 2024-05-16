<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Commission;
use App\Models\Customer;
use App\Models\RentContract;

class RentContractFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RentContract::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rental_period' => $this->faker->numberBetween(-10000, 10000),
            'amount' => $this->faker->numberBetween(-10000, 10000),
            'description' => $this->faker->text,
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'commission_id' => Commission::factory(),
            'customer_id' => Customer::factory(),
        ];
    }
}

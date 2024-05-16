<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Models\MoneyTransfer;

class MoneyTransferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MoneyTransfer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sender_id' => Customer::factory(),
            'receiver_id' => Customer::factory(),
            'amount' => $this->faker->randomFloat(0, 0, 9999999999.),
        ];
    }
}

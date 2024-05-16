<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Models\Order;
use App\Models\WalletTransaction;

class WalletTransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WalletTransaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),
            'order_id' => Order::factory(),
            'amount' => $this->faker->numberBetween(-10000, 10000),
            'type' => $this->faker->randomElement(["in","out"]),
            'payment_type' => $this->faker->randomElement(["creditCard","BankTransfer","Cash"]),
        ];
    }
}

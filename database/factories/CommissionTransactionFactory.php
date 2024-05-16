<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Broker;
use App\Models\CommissionTransaction;
use App\Models\Order;
use App\Models\Partner;
use App\Models\WalletTransaction;

class CommissionTransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommissionTransaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'percentage' => $this->faker->numberBetween(-10000, 10000),
            'value' => $this->faker->numberBetween(-10000, 10000),
            'broker_id' => Broker::factory(),
            'partner_id' => Partner::factory(),
            'order_id' => Order::factory(),
            'wallet_transaction_id' => WalletTransaction::factory(),
        ];
    }
}

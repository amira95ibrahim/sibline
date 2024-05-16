<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Broker;
use App\Models\Partner;
use App\Models\Payment;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'partner_id' => Partner::factory(),
            'broker_id' => Broker::factory(),
            'brief' => $this->faker->text,
            'amount' => $this->faker->randomFloat(0, 0, 9999999999.),
            'date' => $this->faker->date(),
            'document' => $this->faker->text,
        ];
    }
}

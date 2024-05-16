<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Bid;
use App\Models\Customer;
use App\Models\Property;

class BidFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bid::class;

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
            'message_send' => $this->faker->text,
            'message_reply' => $this->faker->text,
            'property_id' => Property::factory(),
            'percentage' => $this->faker->randomFloat(0, 0, 9999999999.),
            'amount' => $this->faker->numberBetween(-10000, 10000),
            'status' => $this->faker->randomElement(["PENDING","APPROVED","DECLINED"]),
        ];
    }
}

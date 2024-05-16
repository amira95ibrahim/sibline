<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Address;
use App\Models\Broker;

class BrokerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Broker::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password,
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'mobile' => $this->faker->word,
            'address_id' => Address::factory(),
            'image' => $this->faker->text,
            'is_verified' => $this->faker->randomElement(["0","1"]),
            'status' => $this->faker->randomElement(["0","1"]),
        ];
    }
}

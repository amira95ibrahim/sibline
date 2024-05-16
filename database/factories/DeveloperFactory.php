<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Address;
use App\Models\Developer;

class DeveloperFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Developer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->safeEmail,
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'mobile' => $this->faker->word,
            'address_id' => Address::factory(),
            'image' => $this->faker->text,
            'notes' => $this->faker->text,
            'status' => $this->faker->randomElement(["0","1"]),
        ];
    }
}

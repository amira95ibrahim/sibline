<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Address;
use App\Models\Partner;

class PartnerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Partner::class;

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
            'website' => $this->faker->word,
            'image' => $this->faker->text,
            'address_id' => Address::factory(),
            'is_verified' => $this->faker->randomElement(["0","1"]),
            'status' => $this->faker->randomElement(["0","1"]),
        ];
    }
}

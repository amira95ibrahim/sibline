<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Address;
use App\Models\Country;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address' => $this->faker->word,
            'country_id' => Country::factory(),
            'city_id' => Country::factory(),
            'area' => $this->faker->word,
            'gps' => $this->faker->word,
            'street' => $this->faker->streetName,
            'zip_code' => $this->faker->word,
            'status' => $this->faker->randomElement(["0","1"]),
        ];
    }
}

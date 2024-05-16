<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Occupation;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

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
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'birth_date' => $this->faker->date(),
            'phone' => $this->faker->phoneNumber,
            'mobile' => $this->faker->word,
            'address_id' => Address::factory(),
            'occupation_id' => Occupation::factory(),
            'passport_number' => $this->faker->word,
            'passport_photo' => $this->faker->word,
            'image' => $this->faker->text,
            'uuid' => $this->faker->uuid,
            'platform' => $this->faker->word,
            'version' => $this->faker->word,
            'is_verified' => $this->faker->randomElement(["0","1"]),
            'status' => $this->faker->randomElement(["0","1"]),
        ];
    }
}

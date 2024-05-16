<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Email;

class EmailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Email::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'driver' => $this->faker->text,
            'host' => $this->faker->text,
            'port' => $this->faker->text,
            'username' => $this->faker->userName,
            'password' => $this->faker->password,
            'encryption' => $this->faker->text,
            'from_address' => $this->faker->text,
            'from_name' => $this->faker->text,
            'status' => $this->faker->randomElement(["0","1"]),
        ];
    }
}

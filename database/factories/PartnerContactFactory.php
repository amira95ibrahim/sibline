<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Partner;
use App\Models\PartnerContact;

class PartnerContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PartnerContact::class;

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
            'position' => $this->faker->word,
            'phone' => $this->faker->phoneNumber,
            'mobile' => $this->faker->word,
            'parent_id' => Partner::factory(),
        ];
    }
}

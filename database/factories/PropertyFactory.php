<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Property;

class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'brief' => $this->faker->text,
            'description' => $this->faker->text,
            'min_investment' => $this->faker->numberBetween(-10000, 10000),
            'max_investment' => $this->faker->numberBetween(-10000, 10000),
            'rental_breakdown' => $this->faker->numberBetween(-10000, 10000),
            'target_Period' => $this->faker->numberBetween(-10000, 10000),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'image' => $this->faker->text,
            'thumb' => $this->faker->text,
            'video' => $this->faker->text,
            'size' => $this->faker->numberBetween(-10000, 10000),
            'status' => $this->faker->randomElement(["0","1"]),
        ];
    }
}

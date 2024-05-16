<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Notification;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->text,
            'receiver_id' => $this->faker->numberBetween(-10000, 10000),
            'receiver_model' => $this->faker->word,
            'reference_id' => $this->faker->numberBetween(-10000, 10000),
            'reference_url' => $this->faker->text,
        ];
    }
}

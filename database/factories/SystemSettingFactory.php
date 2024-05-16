<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\SystemSetting;

class SystemSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SystemSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'short_name' => $this->faker->text,
            'address' => $this->faker->text,
            'footer_text' => $this->faker->text,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'facebook' => $this->faker->text,
            'twitter' => $this->faker->text,
            'youtube' => $this->faker->text,
            'logo_header' => $this->faker->text,
            'logo_footer' => $this->faker->text,
            'favicon' => $this->faker->text,
            'status' => $this->faker->randomElement(["0","1"]),
        ];
    }
}

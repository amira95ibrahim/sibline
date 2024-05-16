<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Permission;

class PermissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Permission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'parent_id' => Permission::factory(),
            'name' => $this->faker->name,
            'icon' => $this->faker->word,
            'menu_url' => $this->faker->word,
            'president' => $this->faker->numberBetween(-10000, 10000),
            'status' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}

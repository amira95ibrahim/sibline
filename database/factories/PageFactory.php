<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Page;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => $this->faker->url,
            'name' => $this->faker->name,
            'title' => $this->faker->sentence(4),
            'content' => $this->faker->paragraphs(3, true),
            'brief' => $this->faker->word,
            'open_in_new_tab' => $this->faker->randomElement(["0","1"]),
            'display_top_menu' => $this->faker->randomElement(["0","1"]),
            'display_sidebar' => $this->faker->randomElement(["0","1"]),
            'president' => $this->faker->numberBetween(-10000, 10000),
            'parent_id' => Page::factory(),
            'icon' => $this->faker->text,
            'photo' => $this->faker->text,
            'status' => $this->faker->randomElement(["0","1"]),
        ];
    }
}

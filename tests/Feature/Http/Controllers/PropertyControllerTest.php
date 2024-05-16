<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PropertyController
 */
class PropertyControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $properties = Property::factory()->count(3)->create();

        $response = $this->get(route('property.index'));

        $response->assertOk();
        $response->assertViewIs('admin.property.index');
        $response->assertViewHas('properties');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('property.create'));

        $response->assertOk();
        $response->assertViewIs('admin.property.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $property = Property::factory()->create();

        $response = $this->get(route('property.edit', $property));

        $response->assertOk();
        $response->assertViewIs('admin.property.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $property = Property::factory()->create();

        $response = $this->get(route('property.show', $property));

        $response->assertOk();
        $response->assertViewIs('admin.property.create');
        $response->assertViewHas('show');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PropertyController::class,
            'store',
            \App\Http\Requests\PropertyStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $title = $this->faker->sentence(4);
        $min_investment = $this->faker->numberBetween(-10000, 10000);
        $max_investment = $this->faker->numberBetween(-10000, 10000);
        $rental_breakdown = $this->faker->numberBetween(-10000, 10000);
        $target_Period = $this->faker->numberBetween(-10000, 10000);
        $size = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->randomElement(/** enum_attributes **/);
        $image = $this->faker->text;

        $response = $this->post(route('property.store'), [
            'title' => $title,
            'min_investment' => $min_investment,
            'max_investment' => $max_investment,
            'rental_breakdown' => $rental_breakdown,
            'target_Period' => $target_Period,
            'size' => $size,
            'status' => $status,
            'image' => $image,
        ]);

        $properties = Property::query()
            ->where('title', $title)
            ->where('min_investment', $min_investment)
            ->where('max_investment', $max_investment)
            ->where('rental_breakdown', $rental_breakdown)
            ->where('target_Period', $target_Period)
            ->where('size', $size)
            ->where('status', $status)
            ->where('image', $image)
            ->get();
        $this->assertCount(1, $properties);
        $property = $properties->first();

        $response->assertRedirect(route('admin.property.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PropertyController::class,
            'update',
            \App\Http\Requests\PropertyUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $property = Property::factory()->create();
        $title = $this->faker->sentence(4);
        $min_investment = $this->faker->numberBetween(-10000, 10000);
        $max_investment = $this->faker->numberBetween(-10000, 10000);
        $rental_breakdown = $this->faker->numberBetween(-10000, 10000);
        $target_Period = $this->faker->numberBetween(-10000, 10000);
        $size = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->randomElement(/** enum_attributes **/);
        $image = $this->faker->text;

        $response = $this->put(route('property.update', $property), [
            'title' => $title,
            'min_investment' => $min_investment,
            'max_investment' => $max_investment,
            'rental_breakdown' => $rental_breakdown,
            'target_Period' => $target_Period,
            'size' => $size,
            'status' => $status,
            'image' => $image,
        ]);

        $property->refresh();

        $response->assertRedirect(route('admin.property.index'));

        $this->assertEquals($title, $property->title);
        $this->assertEquals($min_investment, $property->min_investment);
        $this->assertEquals($max_investment, $property->max_investment);
        $this->assertEquals($rental_breakdown, $property->rental_breakdown);
        $this->assertEquals($target_Period, $property->target_Period);
        $this->assertEquals($size, $property->size);
        $this->assertEquals($status, $property->status);
        $this->assertEquals($image, $property->image);
    }
}

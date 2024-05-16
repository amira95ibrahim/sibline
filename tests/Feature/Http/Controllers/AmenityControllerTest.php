<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Amenity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AmenityController
 */
class AmenityControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $amenities = Amenity::factory()->count(3)->create();

        $response = $this->get(route('amenity.index'));

        $response->assertOk();
        $response->assertViewIs('admin.amenity.index');
        $response->assertViewHas('amenities');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('amenity.create'));

        $response->assertOk();
        $response->assertViewIs('admin.amenity.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $amenity = Amenity::factory()->create();

        $response = $this->get(route('amenity.edit', $amenity));

        $response->assertOk();
        $response->assertViewIs('admin.amenity.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $amenity = Amenity::factory()->create();

        $response = $this->get(route('amenity.show', $amenity));

        $response->assertOk();
        $response->assertViewIs('admin.amenity.create');
        $response->assertViewHas('show');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AmenityController::class,
            'store',
            \App\Http\Requests\AmenityStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $image = $this->faker->text;

        $response = $this->post(route('amenity.store'), [
            'name' => $name,
            'image' => $image,
        ]);

        $amenities = Amenity::query()
            ->where('name', $name)
            ->where('image', $image)
            ->get();
        $this->assertCount(1, $amenities);
        $amenity = $amenities->first();

        $response->assertRedirect(route('admin.amenity.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AmenityController::class,
            'update',
            \App\Http\Requests\AmenityUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $amenity = Amenity::factory()->create();
        $name = $this->faker->name;
        $image = $this->faker->text;

        $response = $this->put(route('amenity.update', $amenity), [
            'name' => $name,
            'image' => $image,
        ]);

        $amenity->refresh();

        $response->assertRedirect(route('admin.amenity.index'));

        $this->assertEquals($name, $amenity->name);
        $this->assertEquals($image, $amenity->image);
    }
}

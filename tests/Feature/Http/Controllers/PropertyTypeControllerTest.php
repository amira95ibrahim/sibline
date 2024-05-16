<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\PropertyType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PropertyTypeController
 */
class PropertyTypeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $propertyTypes = PropertyType::factory()->count(3)->create();

        $response = $this->get(route('property-type.index'));

        $response->assertOk();
        $response->assertViewIs('admin.property_type.index');
        $response->assertViewHas('property_types');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('property-type.create'));

        $response->assertOk();
        $response->assertViewIs('admin.property_type.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $propertyType = PropertyType::factory()->create();

        $response = $this->get(route('property-type.edit', $propertyType));

        $response->assertOk();
        $response->assertViewIs('admin.property_type.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $propertyType = PropertyType::factory()->create();

        $response = $this->get(route('property-type.show', $propertyType));

        $response->assertOk();
        $response->assertViewIs('admin.property_type.create');
        $response->assertViewHas('show');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PropertyTypeController::class,
            'store',
            \App\Http\Requests\PropertyTypeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;

        $response = $this->post(route('property-type.store'), [
            'name' => $name,
        ]);

        $propertyTypes = PropertyType::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $propertyTypes);
        $propertyType = $propertyTypes->first();

        $response->assertRedirect(route('admin.property_type.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PropertyTypeController::class,
            'update',
            \App\Http\Requests\PropertyTypeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $propertyType = PropertyType::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('property-type.update', $propertyType), [
            'name' => $name,
        ]);

        $propertyType->refresh();

        $response->assertRedirect(route('admin.property_type.index'));

        $this->assertEquals($name, $propertyType->name);
    }
}

<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CountryController
 */
class CountryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $countries = Country::factory()->count(3)->create();

        $response = $this->get(route('country.index'));

        $response->assertOk();
        $response->assertViewIs('admin.country.index');
        $response->assertViewHas('countries');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('country.create'));

        $response->assertOk();
        $response->assertViewIs('admin.country.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $country = Country::factory()->create();

        $response = $this->get(route('country.edit', $country));

        $response->assertOk();
        $response->assertViewIs('admin.country.edit');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $country = Country::factory()->create();

        $response = $this->get(route('country.show', $country));

        $response->assertOk();
        $response->assertViewIs('admin.country.show');
        $response->assertViewHas('show');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CountryController::class,
            'store',
            \App\Http\Requests\CountryStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $status = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->post(route('country.store'), [
            'name' => $name,
            'status' => $status,
        ]);

        $countries = Country::query()
            ->where('name', $name)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $countries);
        $country = $countries->first();

        $response->assertRedirect(route('admin.country.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CountryController::class,
            'update',
            \App\Http\Requests\CountryUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $country = Country::factory()->create();
        $name = $this->faker->name;
        $status = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->put(route('country.update', $country), [
            'name' => $name,
            'status' => $status,
        ]);

        $country->refresh();

        $response->assertRedirect(route('admin.country.index'));

        $this->assertEquals($name, $country->name);
        $this->assertEquals($status, $country->status);
    }
}

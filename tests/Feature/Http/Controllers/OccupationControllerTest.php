<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Occupation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\OccupationController
 */
class OccupationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $occupations = Occupation::factory()->count(3)->create();

        $response = $this->get(route('occupation.index'));

        $response->assertOk();
        $response->assertViewIs('admin.occupation.index');
        $response->assertViewHas('occupations');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('occupation.create'));

        $response->assertOk();
        $response->assertViewIs('admin.occupation.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $occupation = Occupation::factory()->create();

        $response = $this->get(route('occupation.edit', $occupation));

        $response->assertOk();
        $response->assertViewIs('admin.occupation.edit');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $occupation = Occupation::factory()->create();

        $response = $this->get(route('occupation.show', $occupation));

        $response->assertOk();
        $response->assertViewIs('admin.occupation.show');
        $response->assertViewHas('show');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OccupationController::class,
            'store',
            \App\Http\Requests\OccupationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $status = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->post(route('occupation.store'), [
            'name' => $name,
            'status' => $status,
        ]);

        $occupations = Occupation::query()
            ->where('name', $name)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $occupations);
        $occupation = $occupations->first();

        $response->assertRedirect(route('admin.occupation.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OccupationController::class,
            'update',
            \App\Http\Requests\OccupationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $occupation = Occupation::factory()->create();
        $name = $this->faker->name;
        $status = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->put(route('occupation.update', $occupation), [
            'name' => $name,
            'status' => $status,
        ]);

        $occupation->refresh();

        $response->assertRedirect(route('admin.occupation.index'));

        $this->assertEquals($name, $occupation->name);
        $this->assertEquals($status, $occupation->status);
    }
}

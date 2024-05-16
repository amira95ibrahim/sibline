<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\RoleController
 */
class RoleControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $roles = Role::factory()->count(3)->create();

        $response = $this->get(route('role.index'));

        $response->assertOk();
        $response->assertViewIs('admin.role.index');
        $response->assertViewHas('roles');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('role.create'));

        $response->assertOk();
        $response->assertViewIs('admin.role.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $role = Role::factory()->create();

        $response = $this->get(route('role.show', $role));

        $response->assertOk();
        $response->assertViewIs('admin.role.show');
        $response->assertViewHas('show');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RoleController::class,
            'store',
            \App\Http\Requests\RoleStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $status = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->post(route('role.store'), [
            'name' => $name,
            'status' => $status,
        ]);

        $roles = Role::query()
            ->where('name', $name)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $roles);
        $role = $roles->first();

        $response->assertRedirect(route('admin.role.index'));
    }
}

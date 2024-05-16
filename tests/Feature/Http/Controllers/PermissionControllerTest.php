<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PermissionController
 */
class PermissionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $permissions = Permission::factory()->count(3)->create();

        $response = $this->get(route('permission.index'));

        $response->assertOk();
        $response->assertViewIs('admin.permission.index');
        $response->assertViewHas('permissions');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('permission.create'));

        $response->assertOk();
        $response->assertViewIs('admin.permission.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $permission = Permission::factory()->create();

        $response = $this->get(route('permission.show', $permission));

        $response->assertOk();
        $response->assertViewIs('admin.permission.show');
        $response->assertViewHas('show');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PermissionController::class,
            'store',
            \App\Http\Requests\PermissionStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $status = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('permission.store'), [
            'name' => $name,
            'status' => $status,
        ]);

        $permissions = Permission::query()
            ->where('name', $name)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $permissions);
        $permission = $permissions->first();

        $response->assertRedirect(route('admin.permission.index'));
    }
}

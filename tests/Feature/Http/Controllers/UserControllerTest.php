<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\UserController
 */
class UserControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $users = User::factory()->count(3)->create();

        $response = $this->get(route('user.index'));

        $response->assertOk();
        $response->assertViewIs('admin.user.index');
        $response->assertViewHas('users');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('user.create'));

        $response->assertOk();
        $response->assertViewIs('admin.user.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $user = User::factory()->create();

        $response = $this->get(route('user.show', $user));

        $response->assertOk();
        $response->assertViewIs('admin.user.show');
        $response->assertViewHas('show');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UserController::class,
            'store',
            \App\Http\Requests\UserStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $email = $this->faker->safeEmail;
        $password = $this->faker->password;
        $first_name = $this->faker->firstName;
        $last_name = $this->faker->lastName;
        $birth_date = $this->faker->date();

        $response = $this->post(route('user.store'), [
            'email' => $email,
            'password' => $password,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'birth_date' => $birth_date,
        ]);

        $users = User::query()
            ->where('email', $email)
            ->where('password', $password)
            ->where('first_name', $first_name)
            ->where('last_name', $last_name)
            ->where('birth_date', $birth_date)
            ->get();
        $this->assertCount(1, $users);
        $user = $users->first();

        $response->assertRedirect(route('admin.user.index'));
    }
}

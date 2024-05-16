<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Developer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DeveloperController
 */
class DeveloperControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $developers = Developer::factory()->count(3)->create();

        $response = $this->get(route('developer.index'));

        $response->assertOk();
        $response->assertViewIs('admin.developer.index');
        $response->assertViewHas('developers');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('developer.create'));

        $response->assertOk();
        $response->assertViewIs('admin.developer.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $developer = Developer::factory()->create();

        $response = $this->get(route('developer.edit', $developer));

        $response->assertOk();
        $response->assertViewIs('admin.developer.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $developer = Developer::factory()->create();

        $response = $this->get(route('developer.show', $developer));

        $response->assertOk();
        $response->assertViewIs('admin.developer.create');
        $response->assertViewHas('show');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DeveloperController::class,
            'store',
            \App\Http\Requests\DeveloperStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $email = $this->faker->safeEmail;
        $name = $this->faker->name;
        $phone = $this->faker->phoneNumber;
        $mobile = $this->faker->word;
        $notes = $this->faker->text;
        $image = $this->faker->text;

        $response = $this->post(route('developer.store'), [
            'email' => $email,
            'name' => $name,
            'phone' => $phone,
            'mobile' => $mobile,
            'notes' => $notes,
            'image' => $image,
        ]);

        $developers = Developer::query()
            ->where('email', $email)
            ->where('name', $name)
            ->where('phone', $phone)
            ->where('mobile', $mobile)
            ->where('notes', $notes)
            ->where('image', $image)
            ->get();
        $this->assertCount(1, $developers);
        $developer = $developers->first();

        $response->assertRedirect(route('admin.developer.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DeveloperController::class,
            'update',
            \App\Http\Requests\DeveloperUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $developer = Developer::factory()->create();
        $email = $this->faker->safeEmail;
        $name = $this->faker->name;
        $phone = $this->faker->phoneNumber;
        $mobile = $this->faker->word;
        $notes = $this->faker->text;
        $image = $this->faker->text;

        $response = $this->put(route('developer.update', $developer), [
            'email' => $email,
            'name' => $name,
            'phone' => $phone,
            'mobile' => $mobile,
            'notes' => $notes,
            'image' => $image,
        ]);

        $developer->refresh();

        $response->assertRedirect(route('admin.developer.index'));

        $this->assertEquals($email, $developer->email);
        $this->assertEquals($name, $developer->name);
        $this->assertEquals($phone, $developer->phone);
        $this->assertEquals($mobile, $developer->mobile);
        $this->assertEquals($notes, $developer->notes);
        $this->assertEquals($image, $developer->image);
    }
}

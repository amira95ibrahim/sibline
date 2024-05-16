<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Broker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BrokerController
 */
class BrokerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $brokers = Broker::factory()->count(3)->create();

        $response = $this->get(route('broker.index'));

        $response->assertOk();
        $response->assertViewIs('admin.broker.index');
        $response->assertViewHas('brokers');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('broker.create'));

        $response->assertOk();
        $response->assertViewIs('admin.broker.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $broker = Broker::factory()->create();

        $response = $this->get(route('broker.edit', $broker));

        $response->assertOk();
        $response->assertViewIs('admin.broker.edit');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $broker = Broker::factory()->create();

        $response = $this->get(route('broker.show', $broker));

        $response->assertOk();
        $response->assertViewIs('admin.broker.show');
        $response->assertViewHas('show');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BrokerController::class,
            'store',
            \App\Http\Requests\BrokerStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $email = $this->faker->safeEmail;
        $phone = $this->faker->phoneNumber;
        $mobile = $this->faker->word;
        $name = $this->faker->name;
        $image = $this->faker->text;

        $response = $this->post(route('broker.store'), [
            'email' => $email,
            'phone' => $phone,
            'mobile' => $mobile,
            'name' => $name,
            'image' => $image,
        ]);

        $brokers = Broker::query()
            ->where('email', $email)
            ->where('phone', $phone)
            ->where('mobile', $mobile)
            ->where('name', $name)
            ->where('image', $image)
            ->get();
        $this->assertCount(1, $brokers);
        $broker = $brokers->first();

        $response->assertRedirect(route('admin.broker.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BrokerController::class,
            'update',
            \App\Http\Requests\BrokerUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $broker = Broker::factory()->create();
        $email = $this->faker->safeEmail;
        $phone = $this->faker->phoneNumber;
        $mobile = $this->faker->word;
        $name = $this->faker->name;
        $image = $this->faker->text;

        $response = $this->put(route('broker.update', $broker), [
            'email' => $email,
            'phone' => $phone,
            'mobile' => $mobile,
            'name' => $name,
            'image' => $image,
        ]);

        $broker->refresh();

        $response->assertRedirect(route('admin.broker.index'));

        $this->assertEquals($email, $broker->email);
        $this->assertEquals($phone, $broker->phone);
        $this->assertEquals($mobile, $broker->mobile);
        $this->assertEquals($name, $broker->name);
        $this->assertEquals($image, $broker->image);
    }
}

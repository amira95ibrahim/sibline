<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CustomerController
 */
class CustomerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $customers = Customer::factory()->count(3)->create();

        $response = $this->get(route('customer.index'));

        $response->assertOk();
        $response->assertViewIs('admin.customer.index');
        $response->assertViewHas('customers');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('customer.create'));

        $response->assertOk();
        $response->assertViewIs('admin.customer.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $customer = Customer::factory()->create();

        $response = $this->get(route('customer.edit', $customer));

        $response->assertOk();
        $response->assertViewIs('admin.customer.edit');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $customer = Customer::factory()->create();

        $response = $this->get(route('customer.show', $customer));

        $response->assertOk();
        $response->assertViewIs('admin.customer.show');
        $response->assertViewHas('show');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CustomerController::class,
            'store',
            \App\Http\Requests\CustomerStoreRequest::class
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
        $first_name = $this->faker->firstName;
        $last_name = $this->faker->lastName;
        $image = $this->faker->text;

        $response = $this->post(route('customer.store'), [
            'email' => $email,
            'phone' => $phone,
            'mobile' => $mobile,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'image' => $image,
        ]);

        $customers = Customer::query()
            ->where('email', $email)
            ->where('phone', $phone)
            ->where('mobile', $mobile)
            ->where('first_name', $first_name)
            ->where('last_name', $last_name)
            ->where('image', $image)
            ->get();
        $this->assertCount(1, $customers);
        $customer = $customers->first();

        $response->assertRedirect(route('admin.customer.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CustomerController::class,
            'update',
            \App\Http\Requests\CustomerUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $customer = Customer::factory()->create();
        $email = $this->faker->safeEmail;
        $phone = $this->faker->phoneNumber;
        $mobile = $this->faker->word;
        $first_name = $this->faker->firstName;
        $last_name = $this->faker->lastName;
        $image = $this->faker->text;

        $response = $this->put(route('customer.update', $customer), [
            'email' => $email,
            'phone' => $phone,
            'mobile' => $mobile,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'image' => $image,
        ]);

        $customer->refresh();

        $response->assertRedirect(route('admin.customer.index'));

        $this->assertEquals($email, $customer->email);
        $this->assertEquals($phone, $customer->phone);
        $this->assertEquals($mobile, $customer->mobile);
        $this->assertEquals($first_name, $customer->first_name);
        $this->assertEquals($last_name, $customer->last_name);
        $this->assertEquals($image, $customer->image);
    }
}

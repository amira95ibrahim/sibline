<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CustomerContact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CustomerContactController
 */
class CustomerContactControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $customerContacts = CustomerContact::factory()->count(3)->create();

        $response = $this->get(route('customer-contact.index'));

        $response->assertOk();
        $response->assertViewIs('admin.customer-contact.index');
        $response->assertViewHas('customer_contacts');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('customer-contact.create'));

        $response->assertOk();
        $response->assertViewIs('admin.customer-contact.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $customerContact = CustomerContact::factory()->create();

        $response = $this->get(route('customer-contact.edit', $customerContact));

        $response->assertOk();
        $response->assertViewIs('admin.customer-contact.edit');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $customerContact = CustomerContact::factory()->create();

        $response = $this->get(route('customer-contact.show', $customerContact));

        $response->assertOk();
        $response->assertViewIs('admin.customer-contact.show');
        $response->assertViewHas('show');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CustomerContactController::class,
            'store',
            \App\Http\Requests\CustomerContactStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $email = $this->faker->safeEmail;

        $response = $this->post(route('customer-contact.store'), [
            'name' => $name,
            'email' => $email,
        ]);

        $customerContacts = CustomerContact::query()
            ->where('name', $name)
            ->where('email', $email)
            ->get();
        $this->assertCount(1, $customerContacts);
        $customerContact = $customerContacts->first();

        $response->assertRedirect(route('admin.customer-contact.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CustomerContactController::class,
            'update',
            \App\Http\Requests\CustomerContactUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $customerContact = CustomerContact::factory()->create();
        $name = $this->faker->name;
        $email = $this->faker->safeEmail;

        $response = $this->put(route('customer-contact.update', $customerContact), [
            'name' => $name,
            'email' => $email,
        ]);

        $customerContact->refresh();

        $response->assertRedirect(route('admin.customer-contact.index'));

        $this->assertEquals($name, $customerContact->name);
        $this->assertEquals($email, $customerContact->email);
    }
}

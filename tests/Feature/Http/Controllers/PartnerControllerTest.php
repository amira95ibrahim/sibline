<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Partner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PartnerController
 */
class PartnerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $partners = Partner::factory()->count(3)->create();

        $response = $this->get(route('partner.index'));

        $response->assertOk();
        $response->assertViewIs('admin.partner.index');
        $response->assertViewHas('partners');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('partner.create'));

        $response->assertOk();
        $response->assertViewIs('admin.partner.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $partner = Partner::factory()->create();

        $response = $this->get(route('partner.edit', $partner));

        $response->assertOk();
        $response->assertViewIs('admin.partner.edit');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $partner = Partner::factory()->create();

        $response = $this->get(route('partner.show', $partner));

        $response->assertOk();
        $response->assertViewIs('admin.partner.show');
        $response->assertViewHas('show');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PartnerController::class,
            'store',
            \App\Http\Requests\PartnerStoreRequest::class
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

        $response = $this->post(route('partner.store'), [
            'email' => $email,
            'phone' => $phone,
            'mobile' => $mobile,
            'name' => $name,
            'image' => $image,
        ]);

        $partners = Partner::query()
            ->where('email', $email)
            ->where('phone', $phone)
            ->where('mobile', $mobile)
            ->where('name', $name)
            ->where('image', $image)
            ->get();
        $this->assertCount(1, $partners);
        $partner = $partners->first();

        $response->assertRedirect(route('admin.partner.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PartnerController::class,
            'update',
            \App\Http\Requests\PartnerUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $partner = Partner::factory()->create();
        $email = $this->faker->safeEmail;
        $phone = $this->faker->phoneNumber;
        $mobile = $this->faker->word;
        $name = $this->faker->name;
        $image = $this->faker->text;

        $response = $this->put(route('partner.update', $partner), [
            'email' => $email,
            'phone' => $phone,
            'mobile' => $mobile,
            'name' => $name,
            'image' => $image,
        ]);

        $partner->refresh();

        $response->assertRedirect(route('admin.partner.index'));

        $this->assertEquals($email, $partner->email);
        $this->assertEquals($phone, $partner->phone);
        $this->assertEquals($mobile, $partner->mobile);
        $this->assertEquals($name, $partner->name);
        $this->assertEquals($image, $partner->image);
    }
}

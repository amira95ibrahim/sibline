<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\RentContract;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\RentContractController
 */
class RentContractControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $rentContracts = RentContract::factory()->count(3)->create();

        $response = $this->get(route('rent-contract.index'));

        $response->assertOk();
        $response->assertViewIs('admin.rent_contract.index');
        $response->assertViewHas('rent_contracts');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('rent-contract.create'));

        $response->assertOk();
        $response->assertViewIs('admin.rent_contract.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $rentContract = RentContract::factory()->create();

        $response = $this->get(route('rent-contract.edit', $rentContract));

        $response->assertOk();
        $response->assertViewIs('admin.rent_contract.edit');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $rentContract = RentContract::factory()->create();

        $response = $this->get(route('rent-contract.show', $rentContract));

        $response->assertOk();
        $response->assertViewIs('admin.rent_contract.show');
        $response->assertViewHas('show');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RentContractController::class,
            'store',
            \App\Http\Requests\RentContractStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $rental_period = $this->faker->numberBetween(-10000, 10000);
        $amount = $this->faker->numberBetween(-10000, 10000);
        $description = $this->faker->text;
        $start_date = $this->faker->date();
        $end_date = $this->faker->date();

        $response = $this->post(route('rent-contract.store'), [
            'rental_period' => $rental_period,
            'amount' => $amount,
            'description' => $description,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);

        $rentContracts = RentContract::query()
            ->where('rental_period', $rental_period)
            ->where('amount', $amount)
            ->where('description', $description)
            ->where('start_date', $start_date)
            ->where('end_date', $end_date)
            ->get();
        $this->assertCount(1, $rentContracts);
        $rentContract = $rentContracts->first();

        $response->assertRedirect(route('admin.rent_contract.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RentContractController::class,
            'update',
            \App\Http\Requests\RentContractUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $rentContract = RentContract::factory()->create();
        $rental_period = $this->faker->numberBetween(-10000, 10000);
        $amount = $this->faker->numberBetween(-10000, 10000);
        $description = $this->faker->text;
        $start_date = $this->faker->date();
        $end_date = $this->faker->date();

        $response = $this->put(route('rent-contract.update', $rentContract), [
            'rental_period' => $rental_period,
            'amount' => $amount,
            'description' => $description,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);

        $rentContract->refresh();

        $response->assertRedirect(route('admin.rent_contract.index'));

        $this->assertEquals($rental_period, $rentContract->rental_period);
        $this->assertEquals($amount, $rentContract->amount);
        $this->assertEquals($description, $rentContract->description);
        $this->assertEquals(Carbon::parse($start_date), $rentContract->start_date);
        $this->assertEquals(Carbon::parse($end_date), $rentContract->end_date);
    }
}

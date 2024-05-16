<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\MoneyTransfer;
use App\Models\Receiver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MoneyTransferController
 */
class MoneyTransferControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $moneyTransfers = MoneyTransfer::factory()->count(3)->create();

        $response = $this->get(route('money-transfer.index'));

        $response->assertOk();
        $response->assertViewIs('admin.money_transfer.index');
        $response->assertViewHas('partners');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('money-transfer.create'));

        $response->assertOk();
        $response->assertViewIs('admin.money_transfer.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $moneyTransfer = MoneyTransfer::factory()->create();

        $response = $this->get(route('money-transfer.edit', $moneyTransfer));

        $response->assertOk();
        $response->assertViewIs('admin.money_transfer.edit');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $moneyTransfer = MoneyTransfer::factory()->create();

        $response = $this->get(route('money-transfer.show', $moneyTransfer));

        $response->assertOk();
        $response->assertViewIs('admin.money_transfer.show');
        $response->assertViewHas('show');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MoneyTransferController::class,
            'store',
            \App\Http\Requests\MoneyTransferStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $amount = $this->faker->randomFloat(/** float_attributes **/);
        $receiver = Receiver::factory()->create();

        $response = $this->post(route('money-transfer.store'), [
            'amount' => $amount,
            'receiver_id' => $receiver->id,
        ]);

        $moneyTransfers = MoneyTransfer::query()
            ->where('amount', $amount)
            ->where('receiver_id', $receiver->id)
            ->get();
        $this->assertCount(1, $moneyTransfers);
        $moneyTransfer = $moneyTransfers->first();

        $response->assertRedirect(route('admin.partner.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MoneyTransferController::class,
            'update',
            \App\Http\Requests\MoneyTransferUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $moneyTransfer = MoneyTransfer::factory()->create();
        $amount = $this->faker->randomFloat(/** float_attributes **/);
        $receiver = Receiver::factory()->create();

        $response = $this->put(route('money-transfer.update', $moneyTransfer), [
            'amount' => $amount,
            'receiver_id' => $receiver->id,
        ]);

        $moneyTransfer->refresh();

        $response->assertRedirect(route('admin.money_transfer.index'));

        $this->assertEquals($amount, $moneyTransfer->amount);
        $this->assertEquals($receiver->id, $moneyTransfer->receiver_id);
    }
}

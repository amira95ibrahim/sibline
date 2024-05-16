<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Commission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CommissionController
 */
class CommissionControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $commissions = Commission::factory()->count(3)->create();

        $response = $this->get(route('commission.index'));

        $response->assertOk();
        $response->assertViewIs('admin.commission.index');
        $response->assertViewHas('commission_transactions');
    }
}

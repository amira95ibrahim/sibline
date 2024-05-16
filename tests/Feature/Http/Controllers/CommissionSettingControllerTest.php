<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CommissionSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CommissionSettingController
 */
class CommissionSettingControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $commissionSettings = CommissionSetting::factory()->count(3)->create();

        $response = $this->get(route('commission-setting.index'));

        $response->assertOk();
        $response->assertViewIs('admin.commission_setting.index');
        $response->assertViewHas('commission_settings');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CommissionSettingController::class,
            'update',
            \App\Http\Requests\CommissionSettingUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $commissionSetting = CommissionSetting::factory()->create();
        $type = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->put(route('commission-setting.update', $commissionSetting), [
            'type' => $type,
        ]);

        $commissionSetting->refresh();

        $response->assertRedirect(route('admin.commission_setting.index'));

        $this->assertEquals($type, $commissionSetting->type);
    }
}

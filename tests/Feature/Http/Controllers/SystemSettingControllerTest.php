<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\SystemSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SystemSettingController
 */
class SystemSettingControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $systemSettings = SystemSetting::factory()->count(3)->create();

        $response = $this->get(route('system-setting.index'));

        $response->assertOk();
        $response->assertViewIs('admin.email.index');
        $response->assertViewHas('system_setting');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SystemSettingController::class,
            'update',
            \App\Http\Requests\SystemSettingUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $systemSetting = SystemSetting::factory()->create();
        $status = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->put(route('system-setting.update', $systemSetting), [
            'status' => $status,
        ]);

        $systemSetting->refresh();

        $response->assertRedirect(route('admin.system-setting.index'));

        $this->assertEquals($status, $systemSetting->status);
    }
}

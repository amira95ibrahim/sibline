<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Email;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\EmailController
 */
class EmailControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $emails = Email::factory()->count(3)->create();

        $response = $this->get(route('email.index'));

        $response->assertOk();
        $response->assertViewIs('admin.email.index');
        $response->assertViewHas('emails');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EmailController::class,
            'update',
            \App\Http\Requests\EmailUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $email = Email::factory()->create();
        $driver = $this->faker->text;
        $host = $this->faker->text;
        $port = $this->faker->text;

        $response = $this->put(route('email.update', $email), [
            'driver' => $driver,
            'host' => $host,
            'port' => $port,
        ]);

        $email->refresh();

        $response->assertRedirect(route('admin.email.index'));

        $this->assertEquals($driver, $email->driver);
        $this->assertEquals($host, $email->host);
        $this->assertEquals($port, $email->port);
    }
}

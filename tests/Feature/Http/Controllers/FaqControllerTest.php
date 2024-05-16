<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Faq;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\FaqController
 */
class FaqControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $faqs = Faq::factory()->count(3)->create();

        $response = $this->get(route('faq.index'));

        $response->assertOk();
        $response->assertViewIs('admin.faq.index');
        $response->assertViewHas('faqs');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('faq.create'));

        $response->assertOk();
        $response->assertViewIs('admin.faq.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $faq = Faq::factory()->create();

        $response = $this->get(route('faq.edit', $faq));

        $response->assertOk();
        $response->assertViewIs('admin.faq.edit');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $faq = Faq::factory()->create();

        $response = $this->get(route('faq.show', $faq));

        $response->assertOk();
        $response->assertViewIs('admin.faq.show');
        $response->assertViewHas('show');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FaqController::class,
            'store',
            \App\Http\Requests\FaqStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $question = $this->faker->text;
        $answer = $this->faker->text;

        $response = $this->post(route('faq.store'), [
            'question' => $question,
            'answer' => $answer,
        ]);

        $faqs = Faq::query()
            ->where('question', $question)
            ->where('answer', $answer)
            ->get();
        $this->assertCount(1, $faqs);
        $faq = $faqs->first();

        $response->assertRedirect(route('admin.faq.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FaqController::class,
            'update',
            \App\Http\Requests\FaqUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $faq = Faq::factory()->create();
        $question = $this->faker->text;
        $answer = $this->faker->text;

        $response = $this->put(route('faq.update', $faq), [
            'question' => $question,
            'answer' => $answer,
        ]);

        $faq->refresh();

        $response->assertRedirect(route('admin.faq.index'));

        $this->assertEquals($question, $faq->question);
        $this->assertEquals($answer, $faq->answer);
    }
}

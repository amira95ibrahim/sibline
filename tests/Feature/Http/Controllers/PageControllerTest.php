<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PageController
 */
class PageControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $pages = Page::factory()->count(3)->create();

        $response = $this->get(route('page.index'));

        $response->assertOk();
        $response->assertViewIs('admin.page.index');
        $response->assertViewHas('pages');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('page.create'));

        $response->assertOk();
        $response->assertViewIs('admin.page.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $page = Page::factory()->create();

        $response = $this->get(route('page.edit', $page));

        $response->assertOk();
        $response->assertViewIs('admin.page.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $page = Page::factory()->create();

        $response = $this->get(route('page.show', $page));

        $response->assertOk();
        $response->assertViewIs('admin.page.create');
        $response->assertViewHas('show');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PageController::class,
            'store',
            \App\Http\Requests\PageStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $url = $this->faker->url;
        $name = $this->faker->name;
        $title = $this->faker->sentence(4);
        $content = $this->faker->paragraphs(3, true);
        $brief = $this->faker->word;
        $open_in_new_tab = $this->faker->randomElement(/** enum_attributes **/);
        $display_top_menu = $this->faker->randomElement(/** enum_attributes **/);
        $display_sidebar = $this->faker->randomElement(/** enum_attributes **/);
        $president = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->post(route('page.store'), [
            'url' => $url,
            'name' => $name,
            'title' => $title,
            'content' => $content,
            'brief' => $brief,
            'open_in_new_tab' => $open_in_new_tab,
            'display_top_menu' => $display_top_menu,
            'display_sidebar' => $display_sidebar,
            'president' => $president,
            'status' => $status,
        ]);

        $pages = Page::query()
            ->where('url', $url)
            ->where('name', $name)
            ->where('title', $title)
            ->where('content', $content)
            ->where('brief', $brief)
            ->where('open_in_new_tab', $open_in_new_tab)
            ->where('display_top_menu', $display_top_menu)
            ->where('display_sidebar', $display_sidebar)
            ->where('president', $president)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $pages);
        $page = $pages->first();

        $response->assertRedirect(route('admin.page.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PageController::class,
            'update',
            \App\Http\Requests\PageUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $page = Page::factory()->create();
        $url = $this->faker->url;
        $name = $this->faker->name;
        $title = $this->faker->sentence(4);
        $content = $this->faker->paragraphs(3, true);
        $brief = $this->faker->word;
        $open_in_new_tab = $this->faker->randomElement(/** enum_attributes **/);
        $display_top_menu = $this->faker->randomElement(/** enum_attributes **/);
        $display_sidebar = $this->faker->randomElement(/** enum_attributes **/);
        $president = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->put(route('page.update', $page), [
            'url' => $url,
            'name' => $name,
            'title' => $title,
            'content' => $content,
            'brief' => $brief,
            'open_in_new_tab' => $open_in_new_tab,
            'display_top_menu' => $display_top_menu,
            'display_sidebar' => $display_sidebar,
            'president' => $president,
            'status' => $status,
        ]);

        $page->refresh();

        $response->assertRedirect(route('admin.page.index'));

        $this->assertEquals($url, $page->url);
        $this->assertEquals($name, $page->name);
        $this->assertEquals($title, $page->title);
        $this->assertEquals($content, $page->content);
        $this->assertEquals($brief, $page->brief);
        $this->assertEquals($open_in_new_tab, $page->open_in_new_tab);
        $this->assertEquals($display_top_menu, $page->display_top_menu);
        $this->assertEquals($display_sidebar, $page->display_sidebar);
        $this->assertEquals($president, $page->president);
        $this->assertEquals($status, $page->status);
    }
}

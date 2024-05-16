<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CustomerContact;
use App\Models\Project;
use App\Models\Projects;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProjectController
 */
class ProjectControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $projects = Project::factory()->count(3)->create();

        $response = $this->get(route('project.index'));

        $response->assertOk();
        $response->assertViewIs('admin.projects.index');
        $response->assertViewHas('projects');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('project.create'));

        $response->assertOk();
        $response->assertViewIs('admin.projects.create');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $project = Project::factory()->create();

        $response = $this->get(route('project.edit', $project));

        $response->assertOk();
        $response->assertViewIs('admin.projects.edit');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $project = Project::factory()->create();

        $response = $this->get(route('project.show', $project));

        $response->assertOk();
        $response->assertViewIs('admin.projects.show');
        $response->assertViewHas('show');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProjectController::class,
            'store',
            \App\Http\Requests\ProjectStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $fiscal_year = $this->faker->year();

        $response = $this->post(route('project.store'), [
            'name' => $name,
            'fiscal_year' => $fiscal_year,
        ]);

        $projects = Projects::query()
            ->where('name', $name)
            ->where('fiscal_year', $fiscal_year)
            ->get();
        $this->assertCount(1, $projects);
        $project = $projects->first();

        $response->assertRedirect(route('admin.project.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProjectController::class,
            'update',
            \App\Http\Requests\ProjectUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $project = Project::factory()->create();
        $name = $this->faker->name;
        $fiscal_year = $this->faker->year();

        $response = $this->put(route('project.update', $project), [
            'name' => $name,
            'fiscal_year' => $fiscal_year,
        ]);

        $project->refresh();

        $response->assertRedirect(route('admin.project.index'));

        $this->assertEquals($name, $project->name);
        $this->assertEquals($fiscal_year, $project->fiscal_year);
    }
}

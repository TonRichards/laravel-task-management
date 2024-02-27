<?php

use App\Models\Checklist;
use App\Models\Space;
use App\Models\Task;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Testing\Fluent\AssertableJson;

beforeEach(function () {
    $this->task = Task::factory()
        ->todo()
        ->for(Type::factory()->task())
        ->for(Space::factory()->for(Type::factory()->space()));
});

it('can show a list of checklist', function () {
    $checklists = Checklist::factory()
        ->count(5)
        ->for($this->task)
            ->state(new Sequence(
                ['is_checked' => true],
                ['is_checked' => false],
            ))
        ->create();

    $this->loggedIn()
        ->getJson('api/v1/checklists?task_id='.$checklists->first()->task->id)
        ->assertSuccessful()
        ->assertJson(function (AssertableJson $json) use ($checklists) {
            $json
                ->has('data', $checklists->count())
                ->has('data.0', function (AssertableJson $json) use ($checklists) {
                    $json
                        ->where('id', $checklists->first()->id)
                        ->where('name', $checklists->first()->name)
                        ->where('task', $checklists->first()->task->name)
                        ->where('is_checked', $checklists->first()->is_checked)
                        ->etc();
                })->etc();
        });
});

it('can store a checklist correctly', function () {
    $task = $this->task->create();

    $data = [
        'name' => 'checklist name',
        'task_id' => $this->task->create()->id,
    ];

    $this->loggedIn()
        ->postJson('api/v1/checklists', [
            'name' => 'checklist name',
            'task_id' => $task->id,
        ])
        ->assertSuccessful()
        ->assertjson(function (AssertableJson $json) use ($task) {
            $json
                ->has('data', function (AssertableJson $json) use ($task) {
                    $json
                        ->where('name', 'checklist name')
                        ->where('task', $task->name)
                        ->etc();
                })->etc();
        });
});

it('needs a proper data to store a checklist', function () {
    $this->loggedIn()->postJson('api/v1/checklists')->assertStatus(422);
});

it('can update a checklist data', function () {
    $checklist = Checklist::factory()->for($this->task)->create();

    $this->loggedIn()
        ->putJson('api/v1/checklists/'.$checklist->id, [
            'name' => 'update checklist data',
        ])
        ->assertSuccessful();

    expect($checklist->fresh()->name)->toBe('update checklist data');
});

it('can update a checklist status', function () {
    $checklist = Checklist::factory()->for($this->task)->create();

    $this->loggedIn()
        ->putJson('api/v1/checklists/'.$checklist->id.'/update-status')
        ->assertSuccessful();

    expect((bool) $checklist->fresh()->is_checked)->toBe(true);
});

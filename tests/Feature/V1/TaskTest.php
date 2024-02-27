<?php

use App\Models\space;
use App\Models\Status;
use App\Models\Task;
use App\Models\Type;
use Illuminate\Testing\Fluent\AssertableJson;

beforeEach(function () {
    $this->space = Space::factory()
        ->for(Type::factory()->space())
        ->create();

    $this->status = Status::factory()
        ->todo()
        ->create();

    $this->type = Type::factory()
        ->task()
        ->create();
});

it('can show list of tasks', function () {
    $tasks = Task::factory()
        ->count(5)
        ->for(Type::factory()->task())
        ->todo()
        ->create([
            'space_id' => $this->space->id,
        ]);

    $this->loggedIn()
        ->getJson('api/v1/tasks?space_id='.$this->space->id)
        ->assertSuccessful()
        ->assertJson(function (AssertableJson $json) use ($tasks) {
            $json
                ->has('data', $tasks->count())
                ->has('data.0', function (AssertableJson $json) use ($tasks) {
                    $json
                        ->where('uuid', $tasks->first()->uuid)
                        ->where('name', $tasks->first()->name)
                        ->where('body', $tasks->first()->body)
                        ->where('space', $tasks->first()->space->name)
                        ->where('type', $tasks->first()->type->display_name)
                        ->etc();
                })->etc();
        });
});

it('can show a task detail', function () {
    $task = Task::factory()
        ->for(Type::factory()->task())
        ->todo()
        ->create([
            'space_id' => $this->space->id,
        ]);

    $this->loggedIn()
        ->getJson('api/v1/tasks/'.$task->uuid)
        ->assertSuccessful()
        ->assertJson(function (AssertableJson $json) use ($task) {
            $json
                ->has('data', function (AssertableJson $json) use ($task) {
                    $json
                        ->where('id', $task->id)
                        ->where('uuid', $task->uuid)
                        ->where('name', $task->name)
                        ->where('body', $task->body)
                        ->etc();
                })->etc();
        });
});

it('can store a task correctly', function () {
    $data = [
        'name' => 'Main task',
        'body' => 'body',
        'space_id' => $this->space->id,
        'type_id' => $this->type->id,
        'status_id' => $this->status->id,
    ];

    $this->loggedIn()
        ->postJson('api/v1/tasks', $data)
        ->assertSuccessful()
        ->assertJson(function (AssertableJson $json) use ($data) {
            $json
                ->has('data', function (AssertableJson $json) use ($data) {
                    $json
                        ->where('name', $data['name'])
                        ->where('body', $data['body'])
                        ->etc();
                })->etc();
        });
});

it('needs proper data to store a task', function () {
    $this->loggedIn()->postJson('/api/v1/tasks')->assertStatus(422);
});

it('can update a task', function () {
    $task = Task::factory()
        ->todo()
        ->create([
            'space_id' => $this->space->id,
            'type_id' => $this->type->id,
        ]);

    $data = [
        'name' => 'name',
        'body' => 'body',
        'type_id' => $this->type->id,
    ];

    $this->loggedIn()
        ->putJson('api/v1/tasks/'.$task->uuid, $data)
        ->assertSuccessful();

    expect($task->fresh()->name)->toBe($data['name']);
    expect($task->fresh()->body)->toBe($data['body']);
});

it('can update status for a task', function () {
    $task = Task::factory()
        ->todo()
        ->create([
            'space_id' => $this->space->id,
            'type_id' => $this->type->id,
        ]);

    $this->loggedIn()
        ->putJson('api/v1/tasks/'.$task->uuid.'/update-status', ['status_id' => 2])
        ->assertSuccessful();

    expect($task->fresh()->status_id)->toBe(2);
});

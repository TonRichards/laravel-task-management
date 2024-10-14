<?php

use App\Enums\Status;
use App\Enums\TaskType;
use App\Models\space;
use App\Models\Task;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->space = Space::factory()
        ->projectType()
        ->for($this->user)
        ->create();
});

it('can show list of tasks', function () {
    $tasks = Task::factory()
        ->count(5)
        ->mainType()
        ->todo()
        ->for($this->space)
        ->for($this->user)
        ->create();

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
                        ->etc();
                })->etc();
        });
});

it('can show a task detail', function () {
    $task = Task::factory()
        ->mainType()
        ->todo()
        ->for($this->space)
        ->for($this->user)
        ->create();

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
        'body' => 'Body',
        'type' => TaskType::MAIN->value,
        'space_id' => $this->space->uuid,
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
        ->mainType()
        ->for($this->space)
        ->for($this->user)
        ->create();

    $data = [
        'name' => 'name',
        'body' => 'body',
        'type' => TaskType::MAIN->value,
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
        ->for($this->space)
        ->for($this->user)
        ->mainType()
        ->create();

    $this->loggedIn()
        ->putJson('api/v1/tasks/'.$task->uuid.'/update-status', ['status' => Status::DONE->value])
        ->assertSuccessful();

    expect($task->fresh()->status)->toBe(Status::DONE->value);
});

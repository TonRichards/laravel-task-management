<?php

use App\Enums\SpaceType;
use App\Models\Space;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

beforeEach(function () {
    $this->type = SpaceType::PROJECT->value;

    $this->user = User::factory()->create();
});

it('can show list of spaces', function () {
    $spaces = Space::factory()
        ->projectType()
        ->for($this->user)
        ->count(3)
        ->create();

    $this->loggedIn()->getJson('/api/v1/spaces')
        ->assertSuccessful()
        ->assertJson(function (AssertableJson $json) use ($spaces) {
            $json
                ->has('data', $spaces->count())
                ->has('data.0', function (AssertableJson $json) use ($spaces) {
                    $json
                        ->where('uuid', $spaces->first()->uuid)
                        ->where('name', $spaces->first()->name)
                        ->etc();
                })->etc();
        });
});

it('can show a space detail', function () {
    $space = Space::factory()
        ->projectType()
        ->for($this->user)
        ->create();

    $this->loggedIn()->getJson('/api/v1/spaces/'.$space->uuid)
        ->assertSuccessful()
        ->assertJson(function (AssertableJson $json) use ($space) {
            $json
                ->has('data')
                ->has('data', function (AssertableJson $json) use ($space) {
                    $json
                        ->where('uuid', $space->uuid)
                        ->where('name', $space->name)
                        ->etc();
                })->etc();
        });
});

it('can create a new space', function () {
    $this->loggedIn()->postJson('/api/v1/spaces', [
        'name' => 'Test create new space',
        'type' => $this->type,
    ])
        ->assertSuccessful()
        ->assertJson(function (AssertableJson $json) {
            $json
                ->has('data')
                ->has('data', function (AssertableJson $json) {
                    $json
                        ->where('name', 'Test create new space')
                        ->etc();
                })
                ->etc();
        });
});

it('needs a proper data to create a new space', function () {
    $this->loggedIn()
        ->postJson('/api/v1/spaces')
        ->assertStatus(422);
});

it('can update a space', function () {
    $space = Space::factory()
        ->projectType()
        ->for($this->user)
        ->create();

    $data['name'] = 'Testing update space';
    $data['type'] = SpaceType::PROJECT->value;

    $this->loggedIn()->putJson('/api/v1/spaces/'.$space->uuid, $data)
        ->assertSuccessful();

    $space = $space->fresh();

    expect($space->name)->toBe($data['name']);
    expect($space->type)->toBe($data['type']);

});

it('can delete space', function () {
    $space = Space::factory()
        ->projectType()
        ->for($this->user)
        ->create();

    $this->loggedIn()->deleteJson('api/v1/spaces/'.$space->uuid)->assertStatus(200);
});

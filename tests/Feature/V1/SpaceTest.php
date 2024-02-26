<?php

use App\Models\Space;
use App\Models\Type;
use Illuminate\Testing\Fluent\AssertableJson;

beforeEach(function () {
    $this->type = Type::factory()->space()->create();
});

it('can show list of spaces', function () {
    $spaces = Space::factory()->count(3)->create([
        'type_id' => $this->type->id,
    ]);

    $this->loggedIn()->getJson('/api/v1/spaces')
        ->assertSuccessful()
        ->assertJson(function (AssertableJson $json) use ($spaces) {
            $json
                ->has('data', $spaces->count())
                ->has('data.0', function (AssertableJson $json) use ($spaces) {
                    $json
                        ->where('uuid', $spaces->first()->uuid)
                        ->where('slug', $spaces->first()->slug)
                        ->where('name', $spaces->first()->name)
                        ->where('type', $spaces->first()->type->display_name)
                        ->etc();
                })->etc();
        });
});

it('can show a space detail', function () {
    $space = Space::factory()->create([
        'type_id' => $this->type->id,
    ]);

    $this->loggedIn()->getJson('/api/v1/spaces/'.$space->uuid)
        ->assertSuccessful()
        ->assertJson(function (AssertableJson $json) use ($space) {
            $json
                ->has('data')
                ->has('data', function (AssertableJson $json) use ($space) {
                    $json
                        ->where('uuid', $space->uuid)
                        ->where('name', $space->name)
                        ->where('type', $space->type->display_name)
                        ->etc();
                })->etc();
        });
});

it('can create a new space', function () {
    $this->loggedIn()->postJson('/api/v1/spaces', [
        'name' => 'Test create new space',
        'type_id' => $this->type->id,
    ])
        ->assertSuccessful()
        ->assertJson(function (AssertableJson $json) {
            $json
                ->has('data')
                ->has('data', function (AssertableJson $json) {
                    $json
                        ->where('name', 'Test create new space')
                        ->where('type', $this->type->display_name)
                        ->etc();
                })
                ->etc();
        });
});

it('needs a proper data to create a new space', function () {
    $this->loggedIn()->postJson('/api/v1/spaces')
        ->assertStatus(422)
        ->assertJson(function (AssertableJson $json) {
            $json
                ->has('errors')
                ->etc();
        });
});

it('can update a space', function () {
    $space = Space::factory()->create([
        'type_id' => $this->type->id,
    ]);

    $data = ['name' => 'Testing update space'];

    $this->loggedIn()->putJson('/api/v1/spaces/'.$space->uuid, $data)
        ->assertSuccessful()
        ->assertJson(function (AssertableJson $json) use ($space, $data) {
            $json
                ->has('data')
                ->has('data', function (AssertableJson $json) use ($space, $data) {
                    $json
                        ->where('uuid', $space->uuid)
                        ->where('name', $data['name'])
                        ->where('type', $space->type->display_name)
                        ->etc();
                })->etc();
        });

});

it('can delete space', function () {
    $space = Space::factory()->create([
        'type_id' => $this->type->id,
    ]);

    $this->loggedIn()->deleteJson('api/v1/spaces/'.$space->uuid)->assertStatus(200);
});

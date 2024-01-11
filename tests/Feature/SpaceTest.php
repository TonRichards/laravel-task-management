<?php

use App\Models\Type;
use App\Models\Space;
use Illuminate\Testing\Fluent\AssertableJson;

it('create a new space', function () {
    $type = Type::factory()->space()->create();

    $this->postJson('/api/v1/spaces', [
        'id' => 1,
        'name' => 'Test create new space',
        'type' => $type->name,
    ])
        ->assertStatus(200)
        ->assertJson(function (AssertableJson $json) use ($type) {
            $json
                ->has('data')
                ->has('data', function (AssertableJson $json) use ($type) {
                    $json->where('type', $type->display_name)->etc();
                })
                ->etc();
        });
});

it('delete space', function () {
    $space = Space::factory()->create();

    $this->deleteJson("api/v1/spaces/{$space->uuid}")->assertStatus(200);
});

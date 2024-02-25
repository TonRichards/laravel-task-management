<?php

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

it('cant show list of users', function () {
    $users = User::factory()->count(5)->create();

    $this->loggedIn()
        ->getJson('api/v1/users')
        ->assertSuccessful()
        ->assertJson(function (AssertableJson $json) use ($users) {
            $json
                ->has('data', 6)
                ->has('data.0', function (AssertableJson $json) use ($users) {
                    $json
                        ->where('uuid', $users->first()->uuid)
                        ->where('name', $users->first()->name)
                        ->where('email', $users->first()->email)
                        ->etc();
                })->etc();
        });
});

it('can show a user detail', function () {
    $user = User::factory()->create();

    $this->loggedIn()
        ->getJson('api/v1/users/'.$user->uuid)
        ->assertSuccessful()
        ->assertJson(function (AssertableJson $json) use ($user) {
            $json
                ->has('data', function (AssertableJson $json) use ($user) {
                    $json
                        ->where('uuid', $user->uuid)
                        ->where('name', $user->name)
                        ->where('email', $user->email)
                        ->etc();
                })->etc();
        });
});

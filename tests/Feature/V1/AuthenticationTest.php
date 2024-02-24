<?php

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

it('can register correctly', function () {
    $this->postJson('/api/v1/auth/register', [
        'name' => 'Ton Nopparat',
        'email' => 'nopparat@gmail.com',
        'password' => 'Task1234',
        'password_confirmation' => 'Task1234',
    ])->assertStatus(201);
});

it('needs a proper data to register', function () {
    $this->postJson('/api/v1/auth/register')->assertStatus(422);
});

it('can loging correctly', function () {
    $user = User::factory()->create();

    $this->postJson('/api/v1/auth/login', [
        'email' => $user->email,
        'password' => 'password',
    ])
        ->assertSuccessful()
        ->assertJson(function (AssertableJson $json) use ($user) {
            $json
                ->has('data')
                ->has('data', function (AssertableJson $json) use ($user) {
                    $json
                        ->where('name', $user->name)
                        ->where('email', $user->email)
                        ->etc();
                })->etc();
        });
});

it('needs a correct data to login', function () {
    $user = User::factory()->create();

    $this->postJson('api/v1/auth/login', [
        'email' => 'something@gamil.com',
        'password' => '1234',
    ])
        ->assertStatus(401);
});

it('can show a current user detail', function () {
    $this->loggedIn()
        ->getJson('api/v1/auth/current')
        ->assertSuccessful();
});

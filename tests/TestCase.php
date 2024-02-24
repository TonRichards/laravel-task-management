<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setup();

        $this->initialSetup();
    }

    public function initialSetup()
    {
        Artisan::call('migrate', ['-vvv' => true]);
        Artisan::call('db:seed', ['-vvv' => true]);
        Artisan::call('passport:install', ['-vvv' => true]);
    }

    public function loggedIn()
    {
        $user = User::factory()->create();

        $response = $this->postJson('api/v1/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->withHeaders(['Authorization' => 'Bearer '.$response['data']['token']]);

        return $this;
    }
}

<?php

declare(strict_types=1);

namespace Tests\Feature\Api\App;

use App\Models\User;
use Tests\Feature\Api\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected string $loginAPIPath = '/api/app/auth/authorize';

    protected string $userID = '';

    protected array $userCredential = [
        'email' => 'test@example.com',
        'password' => 'password',
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create($this->userCredential);
        $this->loginCredential = $this->userCredential;
        $this->userID = $user->id;
    }

    protected function getAuthToken(?array $credential = null): string
    {
        if ($credential === null) {
            $credential = $this->loginCredential;
        }
        $response = $this->postJson($this->loginAPIPath, $credential, [
            // Additional Headers
        ]);

        $token = $response->json('access_token');

        return $token ?? '';
    }
}

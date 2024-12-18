<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Admin;

use App\Models\User;
use Tests\Feature\Api\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected string $loginAPIPath = '/api/auth/signin';

    protected string $userId = '';

    protected array $adminCredential = [
        'email' => 'admin@example.com',
        'password' => 'test_password',
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $adminUserData = [
            ...$this->adminCredential,
            'avatar_url' => null,
            'permissions' => [
                'admin',
            ],
        ];
        $admin = User::factory()->create($adminUserData);
        $this->loginCredential = $this->adminCredential;
        $this->userId = $admin->id;
    }

    protected function getAuthHeaders(): array
    {
        $response = $this->postJson($this->loginAPIPath, $this->loginCredential);
        $token = $response->json('access_token');

        return [
            'Authorization' => "bearer $token",
        ];
    }
}

<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Auth;

use App\Dto\User as UserDto;
use App\Models\User;
use Tests\Feature\Api\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected string $loginAPIPath = '/api/auth/signin';

    protected string $userId = '';

    protected array $adminUserCredential = [
        'email' => 'admin_user@example.com',
        'password' => 'test_password',
    ];

    protected array $normalUserCredential = [
        'email' => 'normal_user@example.com',
        'password' => 'test_password',
    ];

    protected array $loginCredential = [];

    protected User $adminUser;

    protected User $normalUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::factory()->create(
            [
                'name' => 'Test Admin User',
                'permissions' => [UserDto::PERMISSION_ADMIN],
                'email' => $this->adminUserCredential['email'],
                'password' => $this->adminUserCredential['password'],
            ],
        );

        $this->normalUser = User::factory()->create(
            [
                'name' => 'Test Normal User',
                'permissions' => [],
                'email' => $this->normalUserCredential['email'],
                'password' => $this->normalUserCredential['password'],
            ],
        );

        $this->loginCredential = $this->normalUserCredential;
    }

    protected function getAuthToken(?array $credential = null): string
    {
        if ($credential === null) {
            $credential = $this->loginCredential;
        }
        $response = $this->postJson($this->loginAPIPath, $credential);

        return $response->json('access_token');
    }

    protected function getHeaderWithToken(string $token): array
    {
        return [
            'Authorization' => 'bearer '.$token,
        ];
    }
}

<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Admin;

use App\Models\AdminUser;
use Tests\Feature\Api\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected string $loginAPIPath = '/api/admin/auth/login';

    protected string $userID = '';

    protected array $adminCredential = [
        'email' => 'admin@example.com',
        'password' => 'test_password',
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $admin = AdminUser::factory()->create($this->adminCredential);
        $this->loginCredential = $this->adminCredential;
    }

    protected function getAuthHeaders(): array
    {
        $response = $this->postJson($this->loginAPIPath, $this->loginCredential);
        $token = $response->json('token');

        return [
            'Authorization' => "Bearer $token",
        ];
    }
}

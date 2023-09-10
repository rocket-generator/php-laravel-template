<?php

declare(strict_types=1);

namespace Tests\Feature\Api\App;

use App\Models\AdminUser;
use App\Models\User;
use Tests\Feature\Api\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected string $loginAPIPath = '/api/app/auth/registration';

    protected string $userID = '';

    protected array $userCredential = [
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create($this->userCredential);
        $this->loginCredential = $this->userCredential;
    }

    protected function getAuthToken(?array $credential = null): string
    {
        if (null === $credential) {
            $credential = $this->loginCredential;
        }
        $response = $this->postJson($this->loginAPIPath, $credential);

        return $response->json('uiid');
    }

}

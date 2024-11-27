<?php

declare(strict_types=1);

namespace Tests\Feature\Api;

use Tests\Feature\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected string $loginAPIPath = '/api/auth/signin';

    protected string $userId;

    protected array $loginCredential;
}

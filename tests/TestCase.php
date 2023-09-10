<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected bool $useDatabase = false;

    protected function setUp(): void
    {
        parent::setUp();
        if ($this->useDatabase) {
            \Artisan::call('migrate:fresh');
            \Artisan::call('db:seed');
        }
    }
}

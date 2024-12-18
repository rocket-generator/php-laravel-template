<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Contracts\Services\UserServiceInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class UserServiceTest extends TestCase
{
    /**
     * Test UserService create.
     *
     * @throws BindingResolutionException
     */
    public function test_create_user_service_instance_successfully(): void
    {
        $service = app()->make(UserServiceInterface::class);
        self::assertNotNull($service);
    }
}

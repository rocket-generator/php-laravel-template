<?php

declare(strict_types=1);

namespace Tests\Unit\Repositories;

use App\Contracts\Repositories\UserRepositoryInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class UserRepositoryTest extends TestCase
{
    /**
     * Test UserRepository create.
     *
     * @throws BindingResolutionException
     */
    public function testCreateUserRepositoryInstanceSuccessfully(): void
    {
        $repository = app()->make(UserRepositoryInterface::class);
        self::assertNotNull($repository);
    }
}

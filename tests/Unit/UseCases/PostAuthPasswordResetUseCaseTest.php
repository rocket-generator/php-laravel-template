<?php

declare(strict_types=1);

namespace Tests\Unit\UseCases;

use App\Contracts\UseCases\PostAuthPasswordResetUseCaseInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class PostAuthPasswordResetUseCaseTest extends TestCase
{
    /**
     * Test GetMeUseCase create.
     *
     * @throws BindingResolutionException
     */
    public function testCreateGetMeUseCaseInstanceSuccessfully(): void
    {
        $useCase = app()->make(PostAuthPasswordResetUseCaseInterface::class);
        self::assertNotNull($useCase);
    }
}
<?php

declare(strict_types=1);

namespace Tests\Unit\UseCases;

use App\Contracts\UseCases\PostAuthPasswordForgotUseCaseInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class PostAuthPasswordForgotUseCaseTest extends TestCase
{
    /**
     * Test GetMeUseCase create.
     *
     * @throws BindingResolutionException
     */
    public function testCreateGetMeUseCaseInstanceSuccessfully(): void
    {
        $useCase = app()->make(PostAuthPasswordForgotUseCaseInterface::class);
        self::assertNotNull($useCase);
    }
}

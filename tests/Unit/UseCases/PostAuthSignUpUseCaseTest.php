<?php

declare(strict_types=1);

namespace Tests\Unit\UseCases;

use App\Contracts\UseCases\PostAuthSignUpUseCaseInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class PostAuthSignUpUseCaseTest extends TestCase
{
    /**
     * Test GetMeUseCase create.
     *
     * @throws BindingResolutionException
     */
    public function testCreateGetMeUseCaseInstanceSuccessfully(): void
    {
        $useCase = app()->make(PostAuthSignUpUseCaseInterface::class);
        self::assertNotNull($useCase);
    }
}

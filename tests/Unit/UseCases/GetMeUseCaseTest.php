<?php

declare(strict_types=1);

namespace Tests\Unit\UseCases;

use App\Contracts\UseCases\GetMeUseCaseInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class GetMeUseCaseTest extends TestCase
{
    /**
     * Test GetMeUseCase create.
     *
     * @throws BindingResolutionException
     */
    public function testCreateGetMeUseCaseInstanceSuccessfully(): void
    {
        $useCase = app()->make(GetMeUseCaseInterface::class);
        self::assertNotNull($useCase);
    }
}

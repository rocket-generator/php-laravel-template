<?php

declare(strict_types=1);

namespace Tests\Unit\UseCases;

use App\Contracts\UseCases\PutMeUseCaseInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class PutMeUseCaseTest extends TestCase
{
    /**
     * Test PutMeUseCase create.
     *
     * @throws BindingResolutionException
     */
    public function testCreatePutMeUseCaseInstanceSuccessfully(): void
    {
        $useCase = app()->make(PutMeUseCaseInterface::class);
        self::assertNotNull($useCase);
    }
}

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
    public function test_create_put_me_use_case_instance_successfully(): void
    {
        $useCase = app()->make(PutMeUseCaseInterface::class);
        self::assertNotNull($useCase);
    }
}

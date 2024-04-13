<?php

declare(strict_types=1);

namespace App\Contracts\UseCases;

interface PostAuthPasswordForgotUseCaseInterface extends BaseUseCaseInterface
{
    public function handle(string $email): bool;
}

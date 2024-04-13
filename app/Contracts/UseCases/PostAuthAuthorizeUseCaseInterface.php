<?php

declare(strict_types=1);

namespace App\Contracts\UseCases;

use App\Dto\AccessToken;

interface PostAuthAuthorizeUseCaseInterface extends BaseUseCaseInterface
{
    public function handle(string $email, string $password): AccessToken;
}

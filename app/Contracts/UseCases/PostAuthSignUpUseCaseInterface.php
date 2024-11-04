<?php

declare(strict_types=1);

namespace App\Contracts\UseCases;

use App\Dto\AccessToken;

interface PostAuthSignUpUseCaseInterface extends BaseUseCaseInterface
{
    public function handle(array $data): AccessToken;
}

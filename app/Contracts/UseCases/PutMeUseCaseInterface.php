<?php

declare(strict_types=1);

namespace App\Contracts\UseCases;

use App\Dto\User;

interface PutMeUseCaseInterface extends BaseUseCaseInterface
{
    public function handle(array $data): User;
}

<?php

declare(strict_types=1);

namespace App\Contracts\UseCases;

use App\Dto\User;

interface GetMeUseCaseInterface extends BaseUseCaseInterface
{
    public function handle(): User;
}

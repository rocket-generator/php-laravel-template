<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\UseCases\GetMeUseCaseInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Auth\Me;

class MeGetController extends Controller
{
    protected GetMeUseCaseInterface $useCase;

    public function __construct(GetMeUseCaseInterface $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(): Me
    {
        $user = $this->useCase->handle();

        return new Me($user);
    }
}

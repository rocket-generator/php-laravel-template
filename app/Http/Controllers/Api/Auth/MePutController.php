<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\UseCases\PutMeUseCaseInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\PutMeRequest;
use App\Http\Resources\Api\Auth\Me;

class MePutController extends Controller
{
    protected PutMeUseCaseInterface $useCase;

    public function __construct(PutMeUseCaseInterface $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(
        PutMeRequest $request
    ): Me {
        $data = $request->validated();
        $user = $this->useCase->handle($data);

        return new Me($user);
    }
}

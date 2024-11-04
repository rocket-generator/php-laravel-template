<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\UseCases\PostAuthSignUpUseCaseInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\SignUpRequest;
use App\Http\Resources\Api\Auth\AccessToken;

class SignUpPostController extends Controller
{
    protected PostAuthSignUpUseCaseInterface $useCase;

    public function __construct(PostAuthSignUpUseCaseInterface $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(
        SignUpRequest $request
    ): AccessToken {
        $data = $request->validated();
        $accessToken = $this->useCase->handle($data);

        return new AccessToken($accessToken);
    }
}

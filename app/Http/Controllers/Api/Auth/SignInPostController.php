<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\UseCases\PostAuthSignInUseCaseInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\SignInRequest;
use App\Http\Resources\Api\Auth\AccessToken;

class SignInPostController extends Controller
{
    protected PostAuthSignInUseCaseInterface $useCase;

    public function __construct(PostAuthSignInUseCaseInterface $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(
        SignInRequest $request
    ): AccessToken {
        $email = $request->json('email');
        $password = $request->json('password');

        $accessToken = $this->useCase->handle($email, $password);

        return new AccessToken($accessToken);
    }
}

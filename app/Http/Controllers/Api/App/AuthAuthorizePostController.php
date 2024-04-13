<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\App;

use App\Contracts\UseCases\PostAuthAuthorizeUseCaseInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\App\AuthRequest;
use App\Http\Resources\Api\App\AccessToken;

class AuthAuthorizePostController extends Controller
{
    protected PostAuthAuthorizeUseCaseInterface $useCase;

    public function __construct(PostAuthAuthorizeUseCaseInterface $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(
        AuthRequest $request
    ): AccessToken {
        $email = $request->json('email');
        $password = $request->json('password');

        $accessToken = $this->useCase->handle($email, $password);

        return new AccessToken($accessToken);
    }
}

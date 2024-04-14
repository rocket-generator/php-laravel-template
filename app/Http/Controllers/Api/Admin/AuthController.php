<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Admin;

use App\Contracts\Services\AdminUserServiceInterface;
use App\Exceptions\Api\Admin\APIErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\AuthRequest;
use App\Http\Resources\Api\Admin\Token;

class AuthController extends Controller
{
    protected AdminUserServiceInterface $adminUserService;

    public function __construct(
        AdminUserServiceInterface $adminUserService
    ) {
        $this->adminUserService = $adminUserService;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @throws APIErrorException
     */
    public function auth(AuthRequest $request): Token
    {
        $request->validate();
        $credentials = [
            'email' => $request->json('email'),
            'password' => $request->json('password'),
        ];
        $user = $this->adminUserService->signIn($credentials['email'], $credentials['password']);
        if ($user === null) {
            throw new APIErrorException('Wrong Password or Email address', 401);
        }
        $token = $this->adminUserService->getToken();
        if (! $token) {
            throw new APIErrorException('Wrong Password or Email address', 401);
        }

        return Token::token((string) $token, (string) $user->id);
    }
}

<?php

declare(strict_types=1);

namespace App\UseCases;

use App\Contracts\Services\UserServiceInterface;
use App\Contracts\UseCases\PostAuthSignInUseCaseInterface;
use App\Dto\AccessToken;
use App\Exceptions\Services\ClientSideException;
use App\Exceptions\Services\ExternalServiceException;
use App\Exceptions\Services\ServerSideException;

class PostAuthSignInUseCase extends BaseUseCase implements PostAuthSignInUseCaseInterface
{
    protected UserServiceInterface $userService;

    public function __construct(
        UserServiceInterface $userService,
    ) {
        $this->userService = $userService;
    }

    /**
     * @throws ClientSideException
     * @throws ExternalServiceException
     * @throws ServerSideException
     */
    public function handle(string $email, string $password): AccessToken
    {
        $user = $this->userService->signIn($email, $password);
        if (empty($user)) {
            throw new ClientSideException('Invalid email or password', 401);
        }
        $token = $this->userService->getToken();

        return new AccessToken($token, config('jwt.ttl', 60) * 60, 'bearer');
    }
}

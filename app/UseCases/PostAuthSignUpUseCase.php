<?php

declare(strict_types=1);

namespace App\UseCases;

use App\Contracts\Services\UserServiceInterface;
use App\Contracts\UseCases\PostAuthSignUpUseCaseInterface;
use App\Dto\AccessToken;
use App\Exceptions\Services\ClientSideException;
use App\Exceptions\Services\ExternalServiceException;
use App\Exceptions\Services\ServerSideException;

class PostAuthSignUpUseCase extends BaseUseCase implements PostAuthSignUpUseCaseInterface
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
    public function handle(array $data): AccessToken
    {
        $user = $this->userService->signUp($data);
        if (empty($user)) {
            throw new ClientSideException('Something wrong', 401);
        }
        $token = $this->userService->getToken();

        return new AccessToken($token, config('jwt.ttl', 60) * 60, 'bearer');
    }
}

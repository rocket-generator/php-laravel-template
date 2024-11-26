<?php

declare(strict_types=1);

namespace App\UseCases;

use App\Contracts\Services\UserServiceInterface;
use App\Contracts\UseCases\PutMeUseCaseInterface;
use App\Dto\User as UserDto;
use App\Exceptions\Services\ClientSideException;
use App\Exceptions\Services\ExternalServiceException;
use App\Exceptions\Services\ServerSideException;
use App\Models\User as User;

class PutMeUseCase extends BaseUseCase implements PutMeUseCaseInterface
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
    public function handle(array $data): UserDto
    {
        /**
         * @var User $user
         */
        $user = $this->userService->getAuthUser();
        $user = $this->userService->updateUser($user->id, $data);

        return $user;
    }
}

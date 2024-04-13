<?php

declare(strict_types=1);

namespace App\UseCases;

use App\Contracts\Services\UserServiceInterface;
use App\Contracts\UseCases\PostAuthPasswordForgotUseCaseInterface;
use App\Exceptions\Services\ClientSideException;
use App\Exceptions\Services\ExternalServiceException;
use App\Exceptions\Services\ServerSideException;
use Illuminate\Support\Facades\Password;

class PostAuthPasswordForgotUseCase extends BaseUseCase implements PostAuthPasswordForgotUseCaseInterface
{
    protected UserServiceInterface $userService;

    public function __construct(
        UserServiceInterface $userService
    ) {
        $this->userService = $userService;
    }

    /**
     * @throws ClientSideException
     * @throws ExternalServiceException
     * @throws ServerSideException
     */
    public function handle(string $email): bool
    {
        $status = Password::sendResetLink(
            ['email' => $email],
        );

        return $status === Password::RESET_LINK_SENT;
    }
}

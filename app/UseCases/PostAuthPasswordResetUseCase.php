<?php

declare(strict_types=1);

namespace App\UseCases;

use App\Contracts\Services\UserServiceInterface;
use App\Contracts\UseCases\PostAuthPasswordResetUseCaseInterface;
use App\Exceptions\Services\ClientSideException;
use App\Exceptions\Services\ExternalServiceException;
use App\Exceptions\Services\ServerSideException;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class PostAuthPasswordResetUseCase extends BaseUseCase implements PostAuthPasswordResetUseCaseInterface
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
    public function handle(string $email, string $newPassword, string $token): bool
    {
        $status = Password::reset(
            [
                'email' => $email,
                'password' => $newPassword,
                'password_confirmation' => $newPassword,
                'token' => $token,
            ],
            function (User $user, string $password) {
                $this->userService->updatePassword($user->id, $password);
            }
        );
        if ($status === Password::INVALID_TOKEN) {
            throw new ClientSideException('Invalid token', 400);
        }
        if ($status !== Password::PASSWORD_RESET) {
            throw new ClientSideException('failed to change password', 400);
        }

        return true;
    }
}

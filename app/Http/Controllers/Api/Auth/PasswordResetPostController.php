<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\UseCases\PostAuthPasswordResetUseCaseInterface;
use App\Exceptions\Api\App\APIErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\PasswordResetRequest;
use App\Http\Resources\Api\Status;

class PasswordResetPostController extends Controller
{
    protected PostAuthPasswordResetUseCaseInterface $useCase;

    public function __construct(PostAuthPasswordResetUseCaseInterface $useCase)
    {
        $this->useCase = $useCase;
    }

    /**
     * @throws APIErrorException
     */
    public function __invoke(
        PasswordResetRequest $request
    ): Status {
        $data = $request->validated();
        $success = $this->useCase->handle(
            email: $data['email'],
            newPassword: $data['password'],
            token: $data['token'],
        );
        if (! $success) {
            throw new APIErrorException('something wrong', 400);
        }

        return Status::ok('password reset successfully');
    }
}

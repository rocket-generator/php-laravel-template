<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\App;

use App\Contracts\UseCases\PostAuthPasswordForgotUseCaseInterface;
use App\Exceptions\Api\App\APIErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\App\PasswordForgotRequest;
use App\Http\Resources\Api\App\Status;

class AuthPasswordForgotPostController extends Controller
{
    protected PostAuthPasswordForgotUseCaseInterface $useCase;

    public function __construct(PostAuthPasswordForgotUseCaseInterface $useCase)
    {
        $this->useCase = $useCase;
    }

    /**
     * @throws APIErrorException
     */
    public function __invoke(
        PasswordForgotRequest $request
    ): Status {
        $email = $request->json('email');

        $success = $this->useCase->handle($email);
        if (! $success) {
            throw new APIErrorException('something wrong', 400);
        }

        return Status::ok('email for password reset sent');
    }
}

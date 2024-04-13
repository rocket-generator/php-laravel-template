<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\App;

class PasswordForgotRequest extends Request
{
    protected array $rules = [
        'email' => 'required',
    ];
}

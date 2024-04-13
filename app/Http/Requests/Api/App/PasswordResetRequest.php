<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\App;

class PasswordResetRequest extends Request
{
    protected array $rules = [
        'email' => 'required|email',
        'password' => 'required',
        'token' => 'required',
    ];
}

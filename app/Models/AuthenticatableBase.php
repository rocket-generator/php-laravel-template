<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\AuthenticatableBase
 *
 * @property string $password
 * @property int $profile_image_id
 * @property string $api_access_token
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AuthenticatableBase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthenticatableBase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthenticatableBase query()
 *
 * @mixin \Eloquent
 */
class AuthenticatableBase extends Base implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use MustVerifyEmail;
    use Notifiable;

    /**
     * @param  ?string  $password
     *
     * @throws BindingResolutionException
     */
    public function setPasswordAttribute(?string $password): void
    {
        if (empty($password)) {
            $this->attributes['password'] = '';
        } else {
            $this->attributes['password'] = app('hash')->make($password);
        }
    }
}

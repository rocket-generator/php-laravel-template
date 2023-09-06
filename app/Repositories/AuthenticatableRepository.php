<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\AuthenticatableRepositoryInterface;
use App\Models\AuthenticatableBase;
use App\Models\Base;
use App\Utilities\StringUtility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class AuthenticatableRepository extends SingleKeyModelRepository implements AuthenticatableRepositoryInterface
{
    public function getBlankModel(): Base|Builder
    {
        return new AuthenticatableBase();
    }

    public function findByEmail(string $email): ?AuthenticatableBase
    {
        $className = $this->getModelClassName();

        return $className::whereEmail($email)->first();
    }

    public function updateRawPassword(AuthenticatableBase $user, string $password): AuthenticatableBase|Base|Model
    {
        if (empty($password)) {
            \DB::update('update '.$this->getBlankModel()->getTable().' set password = \'\' where id = ?', [$user->id]);
        } else {
            \DB::update(
                'update '.$this->getBlankModel()->getTable().' set password = ? where id = ?',
                [$password, $user->id]
            );
        }

        return $this->find($user->id);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Admin\Me;

class MeController extends Controller
{
    public function getMe(): Me
    {
        $user = auth()->user();
        return new Me($user);
    }
}

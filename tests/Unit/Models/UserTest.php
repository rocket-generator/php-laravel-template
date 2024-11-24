<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\User;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class UserTest extends TestCase
{
    protected bool $useDatabase = true;

    /**
     * Test User create.
     */
    public function test_create_user_model_successfully(): void
    {
        $user = new User;
        self::assertNotNull($user);
    }

    public function test_create_new_user_and_store_it_successfully(): void
    {
        $model = new User;

        $data = User::factory()->make();
        foreach ($data->toFillableArray() as $key => $value) {
            $model->{$key} = $value;
        }
        $model->save();
        self::assertNotNull(User::find($model->id));
    }
}

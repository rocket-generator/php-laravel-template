<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Admin\CRUD;

use App\Models\User;
use Tests\Feature\Api\Admin\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class UsersCRUDTest extends TestCase
{
    public function test_api_get_users_successfully(): void
    {
        $headers = $this->getAuthHeaders();
        $response = $this->get('/api/admin/users', $headers);
        $response->assertStatus(200);
    }

    public function test_api_get_user_successfully(): void
    {
        $model = User::factory()->create();

        $headers = $this->getAuthHeaders();
        $response = $this->get("/api/admin/users/{$model->id}", $headers);
        $response->assertStatus(200);
    }

    public function test_api_create_user_successfully(): void
    {
        $model = User::factory()->make()->toArray();
        $model['password'] = fake()->password;
        $headers = $this->getAuthHeaders();
        $response = $this->postJson('/api/admin/users', $model, $headers);
        $response->assertStatus(201);
    }

    public function test_api_update_user_successfully(): void
    {
        $model = User::factory()->create();
        $newData = fake()->name;

        $headers = $this->getAuthHeaders();
        $response = $this->putJson("/api/admin/users/{$model->id}", [
            'name' => $newData,
        ], $headers);
        $response->assertStatus(200);
    }

    public function test_api_delete_user_successfully(): void
    {
        /** @var User $model */
        $model = User::factory()->create();
        $headers = $this->getAuthHeaders();
        $response = $this->delete("/api/admin/users/{$model->id}", [
        ], $headers);
        $response->assertStatus(200);
    }
}

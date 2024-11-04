<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Auth;

use Illuminate\Support\Facades\Http;

/**
 * @internal
 *
 * @coversNothing
 */
final class MePutAPITest extends TestCase
{
    public function testApiExecuteActionSuccess(): void
    {
        Http::fake();

        $token = $this->getAuthToken();
        $newName = fake()->name;
        $response = $this->putJson(
            route('me.update'),
            [
                'name' => $newName,
            ],
            [
                'Authorization' => 'bearer '.$token,
            ]
        );
        $response->assertStatus(200);
        $this->assertEquals($newName, $response->json('name'));
    }

    public function testApiExecuteActionUpdatePassword(): void
    {
        Http::fake();

        $token = $this->getAuthToken();
        $newPassword = fake()->password;
        $response = $this->putJson(
            route('me.update'),
            [
                'password' => $newPassword,
            ],
            [
                'Authorization' => 'bearer '.$token,
            ]
        );
        $response->assertStatus(200);

        $response = $this->postJson($this->loginAPIPath, $this->loginCredential, [
            'Authorization' => 'bearer '.$token,
        ]);

        $response->assertStatus(401);

        $response = $this->postJson($this->loginAPIPath, [
            'email' => $this->loginCredential['email'],
            'password' => $newPassword,
        ], [
            'Authorization' => 'bearer '.$token,
        ]);

        $response->assertStatus(200);
    }

    public function testApiExecuteActionUpdatePasswordWithBlankSuccess(): void
    {
        Http::fake();

        $token = $this->getAuthToken();
        $newName = fake()->name;
        $response = $this->putJson(
            route('me.update'),
            [
                'name' => $newName,
                'password' => '',
            ],
            [
                'Authorization' => 'bearer '.$token,
            ]
        );
        $response->assertStatus(200);
        $this->assertEquals($newName, $response->json('name'));

        $response = $this->postJson($this->loginAPIPath, $this->loginCredential, [
            'Authorization' => 'bearer '.$token,
        ]);

        $response->assertStatus(200);
    }
}

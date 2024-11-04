<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Auth;

use Illuminate\Support\Facades\Http;

/**
 * @internal
 *
 * @coversNothing
 */
final class SignInPostAPITest extends TestCase
{
    public function testApiExecuteActionSuccess(): void
    {
        Http::fake();

        $response = $this->postJson(
            route('auth.signin'),
            [
                'email' => $this->loginCredential['email'],
                'password' => $this->loginCredential['password'],
            ],
        );
        $response->assertStatus(200);
    }
}

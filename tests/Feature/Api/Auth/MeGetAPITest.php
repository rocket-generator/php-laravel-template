<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Auth;

use Illuminate\Support\Facades\Http;

/**
 * @internal
 *
 * @coversNothing
 */
final class MeGetAPITest extends TestCase
{
    public function test_api_execute_action_success(): void
    {
        Http::fake();

        $token = $this->getAuthToken();
        $response = $this->get(
            route('me.get'),
            [
                'Authorization' => 'bearer '.$token,
            ]
        );
        $response->assertStatus(200);
    }
}

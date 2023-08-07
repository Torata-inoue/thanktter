<?php

namespace Http\API\V1\Resource\Auth;

use App\Domains\User\User;
use App\Http\API\V1\Resources\Auth\AuthResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthResourceTest extends TestCase
{
    use RefreshDatabase;

    public function testResource(): void
    {
        $user = User::factory()->create();
        $actual = (new AuthResource($user))->toJson();
        $expected = json_encode(['user' => $user->toArray()]);

        $this->assertEquals($expected, $actual);
    }
}

<?php

namespace Http\API\V1\Resource\User;

use App\Domains\User\User;
use App\Http\API\V1\Resources\User\UserResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserResourceTest extends TestCase
{
    use RefreshDatabase;

    public function testResource()
    {
        $user = User::factory()->create();
        $actual = (new UserResource($user))->toJson();
        $expected = json_encode([
            'id' => $user->id,
            'name' => $user->name,
            'icon_path' => $user->icon_path
        ]);

        $this->assertEquals($expected, $actual);
    }
}

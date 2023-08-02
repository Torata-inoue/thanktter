<?php

namespace API\V1\User\List;

use App\Domains\User\User;
use App\Library\Http\Response\JsonResponse;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GetUserListTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Sanctum::actingAs(User::factory()->create(), ['*']);
    }

    public function testGetUserList(): void
    {
        User::factory(10)->create();
        $response = $this->get('/api/v1/user/list');

        $expected = User::query()
            ->where('status', '=', User::STATUS_EXIST)
            ->get()
            ->map(fn(User $user) => $user->only(['id', 'name', 'icon_path']))
            ->all();

        $response->assertStatus(200)
            ->assertJson((new JsonResponse($expected))->getData(true));
    }
}

<?php

namespace API\V1\User\List;

use App\Domains\User\User;
use App\Library\Http\Response\JsonResponse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetUserListTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAsSanctum();
    }

    public function testGetUserList(): void
    {
        User::factory(10)->create();
        $response = $this->get(parent::V1_ENDPOINT . '/user/list');

        $expected = User::query()
            ->where('status', '=', User::STATUS_EXIST)
            ->get()
            ->map(fn(User $user) => $user->only(['id', 'name', 'icon_path']))
            ->all();

        $response->assertStatus(200)
            ->assertJson((new JsonResponse($expected))->getData(true));
    }
}

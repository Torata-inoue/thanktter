<?php

namespace Service\User;

use App\Domains\User\User;
use App\Service\User\ListService;
use Tests\TestCase;

class ListServiceTest extends TestCase
{
    private ListService $listService;

    public function setUp(): void
    {
        parent::setUp();
        $this->listService = $this->app->make(ListService::class);
    }

    public function testGetUserList(): void
    {
        User::factory(10)->create();
        $actual = $this->listService->getUserList();
        $expected = User::query()
            ->where('status', '=', User::STATUS_EXIST)
            ->get()
            ->map(fn(User $user) => $user->only(['id', 'name', 'icon_path']))
            ->all();

        $this->assertEquals($expected, $actual);
    }
}

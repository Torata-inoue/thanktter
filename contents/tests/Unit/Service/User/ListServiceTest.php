<?php

namespace Service\User;

use App\Domains\User\User;
use App\Service\User\ListService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListServiceTest extends TestCase
{
    use RefreshDatabase;

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
            ->get();

        $this->assertEquals($expected, $actual);
    }
}

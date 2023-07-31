<?php

namespace Tests\Unit;

use App\Domains\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function testExample(): void
    {
        $this->assertTrue(true);
    }

    public function testConnectDb(): void
    {
        $user = User::factory()->create();
        $this->assertTrue($user->exists);
    }
}

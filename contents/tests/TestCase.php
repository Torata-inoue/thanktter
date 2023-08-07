<?php

namespace Tests;

use App\Domains\User\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    const V1_ENDPOINT = '/api/v1';

    /**
     * @param array<string> $abilities
     * @return void
     */
    protected function actingAsSanctum(array $abilities = ['*']): void
    {
        Sanctum::actingAs(User::factory()->create(), $abilities);
    }
}

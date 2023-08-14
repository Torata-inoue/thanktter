<?php

namespace Tests\Feature\API\V1\Comment;

use Tests\TestCase;

class GetCommentControllerTest extends TestCase
{
    public function setUp(): void
    {
        $this->actingAsSanctum();
    }

    public function testGetComment(): void
    {
        $response = $this->get(parent::V1_ENDPOINT . '/comment?page=1');
        $response->assertStatus(200);
    }
}

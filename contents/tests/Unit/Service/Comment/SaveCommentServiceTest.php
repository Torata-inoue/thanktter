<?php

namespace Service\Comment;

use App\Domains\Comment\Comment;
use App\Domains\Reaction\ReactionType;
use App\Domains\User\User;
use App\Service\Comment\SaveCommentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaveCommentServiceTest extends TestCase
{
    use RefreshDatabase;

    private SaveCommentService $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAsSanctum();

        $this->service = app(SaveCommentService::class);
    }

    public function testSaveCommentAndNominees()
    {
        $nominee_ids = User::factory(5)->create()
            ->map(fn (User $user) => $user->id)->all();
        ['comment' => $comment] = $this->service->createComment('ありがとう！', $nominee_ids, []);

        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'text' => $comment->text
        ]);

        foreach ($nominee_ids as $nominee_id) {
            $this->assertDatabaseHas('nominees', [
                'user_id' => $nominee_id,
                'comment_id' => $comment->id
            ]);
        }
    }

    public function testReturnValue(): void
    {
        $nominee_ids = User::factory(5)->create()
            ->map(fn (User $user) => $user->id)->all();
        ['comment' => $comment, 'reactions' => $reactions] = $this->service->createComment('ありがとう！', $nominee_ids, []);

        $this->assertEquals([
            ['type' => ReactionType::GOOD->value, 'count' => 0],
            ['type' => ReactionType::EMPATHY->value, 'count' => 0],
            ['type' => ReactionType::THANKS->value, 'count' => 0],
            ['type' => ReactionType::CONGRATULATION->value, 'count' => 0],
            ['type' => ReactionType::FIGHT->value, 'count' => 0],
        ], $reactions);

        $this->assertTrue($comment->exists && $comment instanceof Comment);
    }
}

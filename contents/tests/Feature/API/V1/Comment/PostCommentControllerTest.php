<?php

namespace API\V1\Comment;

use App\Domains\Comment\Comment;
use App\Domains\Reaction\ReactionType;
use App\Domains\User\User;
use App\Http\API\V1\Resources\Comment\CommentResource;
use App\Library\Http\Response\JsonResponse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostCommentControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Collection<int, User>
     */
    private Collection $users;

    public function setUp(): void
    {
        parent::setUp();
        $this->users = User::factory(10)->create();
        $this->actingAsSanctum();
    }

    public function testPostComment(): void
    {
        $request_data = [
            'text' => 'ありがとうございます！',
            'nomineeIds' => $this->users->pluck('id')->all(),
            'images' => []
        ];
        $response = $this->post(parent::V1_ENDPOINT . '/comment', $request_data);

        $comment = Comment::query()
            ->with('belongsToUser')
            ->with('hasManyReplies')
            ->with('belongsToManyNominees')
            ->first();
        $reactions = [
            ['type' => ReactionType::GOOD->value, 'count' => 0],
            ['type' => ReactionType::EMPATHY->value, 'count' => 0],
            ['type' => ReactionType::THANKS->value, 'count' => 0],
            ['type' => ReactionType::CONGRATULATION->value, 'count' => 0],
            ['type' => ReactionType::FIGHT->value, 'count' => 0],
        ];

        $resource = new CommentResource(compact('comment', 'reactions'));
        $response->assertStatus(200)
            ->assertJson((new JsonResponse($resource))->getData(true));
    }

    // TODO
//    public function testPostCommentWithImage(): void
//    {
//
//    }
}

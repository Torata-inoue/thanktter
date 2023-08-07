<?php

namespace Http\API\V1\Resource\Comment;

use App\Domains\Comment\Comment;
use App\Domains\User\User;
use App\Http\API\V1\Resources\Comment\ReplyResource;
use App\Http\API\V1\Resources\User\UserResource;
use Tests\TestCase;

class ReplyResourceTest extends TestCase
{
    public function testResource()
    {

        $comment = Comment::factory()->create(['user_id' => User::factory()->create()->id]);
        $replyUser = User::factory()->create();
        $reply = Comment::factory()->create([
            'user_id' => $replyUser->id,
            'reply_to' => $comment->id
        ]);
        $reply->setRelation('belongsToUser', $replyUser);

        $actual = (new ReplyResource($reply))->toJson();
        $expected = json_encode([
            'user' => new UserResource($replyUser),
            'text' => $reply->text,
            'replyId' => $reply->id
        ]);

        $this->assertEquals($expected, $actual);
    }
}

<?php

namespace Database\Seeders\Comment;

use App\Domains\Comment\Comment;
use App\Domains\Nominee\Nominee;
use App\Domains\User\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create([
            'user_id' => $user->id
        ]);

        User::factory(3)
            ->create()
            ->map(fn (User $user) => Nominee::factory()->create([
                'user_id' => $user->id,
                'comment_id' => $comment->id
            ]));
    }

}

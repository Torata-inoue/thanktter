<?php

namespace App\Service\Comment;

use App\Domains\Comment\Comment;
use App\Domains\Comment\CommentRepository;
use App\Domains\Comment\Image\CommentImage;
use App\Domains\Comment\Image\CommentImageRepository;
use App\Domains\Nominee\Nominee;
use App\Domains\Nominee\NomineeRepository;
use App\Domains\Reaction\ReactionType;
use App\Domains\User\UserRepository;
use App\Library\Image\UploaderInterface;
use App\Service\BaseService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

readonly class SaveCommentService extends BaseService
{
    public function __construct(
        private CommentRepository $commentRepository,
        private NomineeRepository $nomineeRepository,
        private UserRepository $userRepository,
        private CommentImageRepository $commentImageRepository,
        private UploaderInterface $uploader
    ) {
        parent::__construct();
    }

    /**
     * @param string $text
     * @param int[] $nomineeIds
     * @param UploadedFile[] $images
     * @return array{comment: Comment, reactions: array<int, array<string, int>>}
     * @throws \Throwable
     */
    public function createComment(string $text, array $nomineeIds, array $images): array
    {
        $comment = new Comment([
            'user_id' => $this->auth->id,
            'text' => $text
        ]);

        $images = $this->uploadImages($images);
        $users = $this->userRepository->getByIds($nomineeIds);

        \DB::transaction(function () use ($comment, $users, $images) {
            $this->commentRepository->save($comment);

            foreach ($users as $user) {
                $nominee = new Nominee([
                    'comment_id' => $comment->id,
                    'user_id' => $user->id
                ]);
                $this->nomineeRepository->save($nominee);
            }

            /** @var CommentImage $image */
            foreach ($images as $index => $image) {
                $image->fill([
                    'comment_id' => $comment->id,
                    'order' => $index + 1
                ]);
                $this->commentImageRepository->save($image);
            }
        });

        $comment->user = $this->auth;
        $comment->replies = new Collection();  // @phpstan-ignore-line
        $comment->nominees = $users;
        $comment->images = $images;

        return [
            'comment' => $comment,
            'reactions' => [
                ['type' => ReactionType::GOOD->value, 'count' => 0],
                ['type' => ReactionType::EMPATHY->value, 'count' => 0],
                ['type' => ReactionType::THANKS->value, 'count' => 0],
                ['type' => ReactionType::CONGRATULATION->value, 'count' => 0],
                ['type' => ReactionType::FIGHT->value, 'count' => 0],
            ]
        ];
    }

    /**
     * @param UploadedFile[] $images
     * @return Collection<int, CommentImage>
     */
    private function uploadImages(array $images): Collection
    {
        // @phpstan-ignore-next-line
        return new Collection(array_map(function (UploadedFile $image): CommentImage {
            $name = $this->uploader->upload($image);
            return new CommentImage(compact('name'));
        }, $images));
    }
}

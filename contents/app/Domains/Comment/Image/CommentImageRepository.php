<?php

namespace App\Domains\Comment\Image;

use App\Domains\Repository;
use Illuminate\Database\Eloquent\Builder;

/**
 * @extends Repository<CommentImage, Builder<CommentImage>>
 */
class CommentImageRepository extends Repository
{
    public function __construct(CommentImage $commentImage)
    {
        parent::__construct($commentImage);
    }

    public function save(CommentImage $commentImage): bool
    {
        return $commentImage->save();
    }
}

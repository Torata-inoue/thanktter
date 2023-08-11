<?php

namespace App\Library\Image;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

readonly class ImageUploader implements UploaderInterface
{
    public function __construct(private ImageManager $imageManager)
    {
    }

    public function upload(UploadedFile $file): string
    {
        $image = $this->imageManager->make($file->getRealPath());
        $name = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $dir = 'app/public/' . config('common.image.base_path') . '/comment/';

        $image->save(storage_path("{$dir}{$name}"), self::QUALITY);

        return $name;
    }
}

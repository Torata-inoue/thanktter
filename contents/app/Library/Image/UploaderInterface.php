<?php

namespace App\Library\Image;

use Illuminate\Http\UploadedFile;

interface UploaderInterface
{
    const QUALITY = 50;

    public function upload(UploadedFile $file): string;
}

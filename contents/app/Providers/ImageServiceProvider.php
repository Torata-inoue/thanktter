<?php

namespace App\Providers;

use App\Library\Image\ImageUploader;
use App\Library\Image\S3Uploader;
use App\Library\Image\UploaderInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageManager;

class ImageServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->instance(ImageManager::class, new ImageManager(['driver' => 'imagick']));

        if ($this->app->environment(['production', 'prod', 'stg', 'staging'])) {
            $this->app->bind(UploaderInterface::class, S3Uploader::class);
        } else {
            $this->app->bind(UploaderInterface::class, ImageUploader::class);
        }
    }

    /**
     * @return string[]
     */
    public function provides(): array
    {
        return [
            ImageManager::class,
            UploaderInterface::class
        ];
    }
}

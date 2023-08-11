<?php

namespace App\Library\Image;

use Aws\S3\S3Client;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

readonly class S3Uploader implements UploaderInterface
{
    /**
     * @var array<string, string>
     */
    private array $config;

    public function __construct(private ImageManager $imageManager)
    {
        $this->config = config('common.image');
    }

    public function upload(UploadedFile $file): string
    {
        $image = $this->imageManager->make($file);

        $compressedImage = (string) $image->encode($file->getClientOriginalExtension(), self::QUALITY);
        $s3 = $this->getS3Client();

        $name = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $dir = config('common.image.base_path') . '/comment/';

        // S3にアップロード
        $s3->putObject([
            'Bucket' => env('AWS_BUCKET'),
            'Key'    => "{$dir}{$name}",
            'Body'   => $compressedImage,
            'ACL'    => 'public-read',
            'ContentType' => 'image/jpeg',
        ]);

        return $name;
    }

    private function getS3Client(): S3Client
    {
        return new S3Client([
            'version' => 'latest',
            'region'  => $this->config['region'],
            'credentials' => [
                'key'    => $this->config['access_key_id'],
                'secret' => $this->config['secret_key'],
            ],
        ]);
    }
}

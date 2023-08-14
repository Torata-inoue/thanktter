<?php

use App\Domains\Comment\Image\CommentImage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comment_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comment_id');
            $table->unsignedTinyInteger('order');
            $table->string('name', 50);
            $table->unsignedTinyInteger('status')->default(CommentImage::STATUS_EXIST);
            $table->timestamps();

            $table->unique(['comment_id', 'status', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_images');
    }
};

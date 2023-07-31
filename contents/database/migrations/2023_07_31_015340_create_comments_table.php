<?php

use App\Domains\Comment\Comment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const TABLE = 'comments';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->text('text');
            $table->tinyInteger('status')->default(Comment::STATUS_EXIST);
            $table->unsignedTinyInteger('type')->default(Comment::TYPE_DEFAULT);
            $table->unsignedInteger('reply_to')->default(Comment::NOT_REPLY_COMMENT);
            $table->timestamps();


            $table->index('reply_to');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
};

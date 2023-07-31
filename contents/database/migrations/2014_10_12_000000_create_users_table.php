<?php

use App\Domains\User\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const TABLE = 'users';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->id();

            $table->string('name', 30);
            $table->string('email', 50);
            $table->unsignedInteger('department_id');
            $table->unsignedInteger('occupation_id');
            $table->string('join_date');
            $table->string('birthday');
            $table->string('icon_path', 45)->default('');
            $table->string('password', 128);
            $table->text('comment');

            $table->string('chatwork_id')->nullable();
            $table->tinyInteger('permission')->default(User::PERMISSION_USER);
            $table->tinyInteger('status')->default(User::STATUS_EXIST);
            $table->integer('stamina')->default(config('common.user.stamina.max'));
            $table->date('last_login');
            $table->unsignedTinyInteger('rank')->default(1);
            $table->rememberToken();
            $table->timestamps();

            $table->unique('email');
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

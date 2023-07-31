<?php

namespace Database\Factories\Domains\User;

use App\Domains\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'department_id' => $this->faker->randomNumber(),
            'occupation_id' => $this->faker->randomNumber(),
            'join_date' => $this->faker->date(),
            'birthday' => $this->faker->date(),
            'icon_path' => $this->faker->filePath(),
            'password' => \Hash::make($this->faker->text(20)),
            'comment' => $this->faker->text('50'),
            'chatwork_id' => $this->faker->randomNumber(),
            'last_login' => Carbon::now(),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }
}

<?php

namespace Database\Factories\Reaction;

use App\Domains\Reaction\Reaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reaction>
 */
class ReactionFactory extends Factory
{
    protected $model = Reaction::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_at' => $this->faker->date('Y-m-d HiH:i:s')
        ];
    }
}

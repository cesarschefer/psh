<?php

namespace Database\Factories;

use App\Models\Player;
use App\Models\Statistic;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Statistic>
 */
class StatisticFactory extends Factory
{

    protected $model = Statistic::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition(): array
    {
        $playerUUIDs = Player::pluck('uuid')->toArray();
        return [
            'player_uuid' => $this->faker->randomElement($playerUUIDs),
            'score' => random_int(1,100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

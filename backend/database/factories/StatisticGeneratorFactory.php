<?php

namespace Database\Factories;

use App\Models\StatisticGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StatisticGenerator>
 */
class StatisticGeneratorFactory extends Factory
{
    protected $model = StatisticGenerator::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'last_generated' => now()
        ];
    }
}

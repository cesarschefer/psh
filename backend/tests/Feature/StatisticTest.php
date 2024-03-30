<?php

namespace Tests\Feature;

use App\Http\Resources\StatisticResource;
use App\Models\Statistic;
use App\Models\Player;
use App\Models\StatisticGenerator;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StatisticTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Player::factory()->count(10)->create();
        Statistic::factory()->count(20)->create();
        StatisticGenerator::factory()->count(10)->create();
    }


    public function test_returns_ten_best_scores(): void
    {
        //Arrange
        $bestScores = Statistic::with('player')
                        ->orderBy('score','desc')
                        ->take(10)
                        ->get();

        //Act
        $response = $this->get('/api/statistics');
        $responseData = $response->json()['data'];
        $expectedIds = $bestScores->pluck('id')->toArray();
        $actualIds = collect($responseData)->pluck('id')->toArray();

        //Assert
        $response->assertStatus(200);
        $this->assertCount(10, $responseData);
        $this->assertEquals($expectedIds, $actualIds);
    }

    public function test_last_generated_stats_are_returned(): void
    {
        //Arrange
        $lastGenerated = StatisticGenerator::latest('last_generated')->pluck('last_generated')->first();
        $formattedLastGenerated = Carbon::parse($lastGenerated)->format('d-m-Y H:i:s');

        //Act
        $response = $this->get('/api/statistics');
        $responseData = $response->json()['last_generated'];

        //Assert
        $this->assertEquals($responseData, $formattedLastGenerated );
    }

}

<?php

namespace Tests\Feature;

use App\Http\Resources\StatisticResource;
use App\Models\Statistic;
use App\Models\Player;
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

}

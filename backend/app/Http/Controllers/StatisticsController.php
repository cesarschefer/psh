<?php

namespace App\Http\Controllers;

use App\Http\Resources\StatisticResource;
use App\Models\Player;
use App\Models\Statistic;
use App\Models\StatisticGenerator;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StatisticsController extends Controller
{

    public function index(): array
    {
        $statistics = $this->getTenBestScores();
        $lastGenerated = StatisticGenerator::latest('last_generated')->pluck('last_generated')->first();
        return [
            'data' => StatisticResource::collection($statistics),
            'last_generated' => Carbon::parse($lastGenerated)->format('d-m-Y H:i:s')
        ];
    }

    public function export(): JsonResponse
    {
        $statistics = $this->getTenBestScores();

        $lastGenerated = StatisticGenerator::latest('last_generated')->pluck('last_generated')->first();
        $content = "statID,playerID,nickname,profileImage,creationDate,score\n";
        foreach ($statistics as $statistic) {
            $content .= "{$statistic->id},";
            $content .= "{$statistic->player_uuid},";
            $content .= "{$statistic->player->nickname},";
            $content .= "{$statistic->player->profile_image},";
            $content .= "{$statistic->player->created_at},";
            $content .= "{$statistic->player->updated_at},";
            $content .= "\n";
        }
        $content .= "Last time stats generated: " . Carbon::parse($lastGenerated)->format('d-m-Y H:i:s');

        return $this->sendResponse(true, 'Data exported successfully', base64_encode($content), Response::HTTP_OK);
    }
    /**
     * @throws Exception
     */
    public function store(): JsonResponse
    {
        $playersCount = random_int(1,10);
        $response = Http::get('https://randomuser.me/api/?results=' . $playersCount);
        if($response->status() === Response::HTTP_OK) {
            $players = $response->json()['results'];

            DB::beginTransaction();

            try {
                foreach ($players as $player) {

                    Player::updateOrCreate(
                        ['uuid' => $player['login']['uuid']],
                        [
                            'nickname' => $player['login']['username'],
                            'profile_image' => $player['picture']['medium']
                        ]
                    );
                    $statistic = new Statistic();
                    $statistic->player_uuid = $player['login']['uuid'];
                    $statistic->score = random_int(1,100);
                    $statistic->save();
                }

                StatisticGenerator::create(['last_generated' => now()]);
                DB::commit();
                return $this->sendResponse(true,count($players) . ' statistics were inserted on database', [], Response::HTTP_OK);
            } catch (Exception $ex) {
                DB::rollBack();
                return $this->sendResponse(false, 'Failed to insert statistics', [], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            return $this->sendResponse(false, 'API call failed', [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    private function getTenBestScores(): Collection
    {
        return Statistic::with('player')
            ->orderBy('score','desc')
            ->take(10)
            ->get();
    }
}

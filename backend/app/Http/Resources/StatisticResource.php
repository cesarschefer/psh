<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatisticResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->player_uuid,
            'nickname' => $this->player->nickname,
            'profileImage' => $this->player->profile_image,
            'creationDate' => $this->created_at,
            'score' => $this->score
        ];
    }
}

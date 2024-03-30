<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = ['player_uuid','score'];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player_uuid','uuid');
    }

}

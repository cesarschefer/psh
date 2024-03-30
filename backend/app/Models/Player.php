<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    use HasFactory;

    protected $fillable = ['uuid','nickname','profile_image'];

    public function statistics(): HasMany
    {
        return $this->hasMany(Statistic::class,'player_uuid','uuid');

    }
}

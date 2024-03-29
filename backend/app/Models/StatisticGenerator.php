<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticGenerator extends Model
{
    use HasFactory;

    protected $table = 'statistics_generation';
    public $timestamps = false;
    protected $fillable = ['last_generated'];
}

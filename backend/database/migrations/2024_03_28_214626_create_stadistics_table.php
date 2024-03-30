<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->uuid('player_uuid');
            $table->foreign('player_uuid')->references('uuid')->on('players');
            $table->tinyInteger('score');
            $table->timestamps();
        });

        DB::table('statistics')->insert([
            'player_uuid' => 'bc0a5341-f833-4942-b157-60b505e7cfb5',
            'score' => random_int(1,100),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('statistics')->insert([
            'player_uuid' => '540e7bbd-485d-4de9-9ef4-6aed00574969',
            'score' => random_int(1,100),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('statistics')->insert([
            'player_uuid' => '63d87a6e-25ac-4ae4-b2bf-470083108d0d',
            'score' => random_int(1,100),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};

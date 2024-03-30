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
        Schema::create('players', function (Blueprint $table) {

            $table->uuid('uuid')->primary();
            $table->string('nickname');
            $table->string('profile_image');
            $table->timestamps();
        });

        DB::table('players')->insert([
            'uuid' => 'bc0a5341-f833-4942-b157-60b505e7cfb5',
            'nickname' => 'lazygorilla150',
            'profile_image' => 'https://randomuser.me/api/portraits/med/women/3.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('players')->insert([
            'uuid' => '540e7bbd-485d-4de9-9ef4-6aed00574969',
            'nickname' => 'goldengorilla668',
            'profile_image' => 'https://randomuser.me/api/portraits/med/women/0.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('players')->insert([
            'uuid' => '63d87a6e-25ac-4ae4-b2bf-470083108d0d',
            'nickname' => 'bigdog471',
            'profile_image' => 'https://randomuser.me/api/portraits/med/women/68.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};

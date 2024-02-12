<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('trackTitle', 32); // 32文字までの文字列
            $table->string('pathArtwork')->nullable();
            $table->integer('bpm');
            $table->string('key')->nullable();
            $table->string('pathSampleFile')->nullable(); // ファイルパスやファイル名を保存する場合
            $table->string('pathDownloadFile')->nullable(); // ファイルパスやファイル名を保存する場合
            $table->integer('price');
            $table->text('additionalInfo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};

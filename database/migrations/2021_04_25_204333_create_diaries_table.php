<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diaries', function (Blueprint $table) {
            $table->id();
            $table->longText('content');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('emoji_icon_id')->references('id')->on('emoji_icons');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropColumns('diaries', ['emoji_icon_id']);
        // Schema::dropColumns('diaries', ['user_id']);
        Schema::dropIfExists('diaries');
    }
}

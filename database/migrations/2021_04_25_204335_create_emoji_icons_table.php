<?php

use App\Models\EmojiIcon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmojiIconsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emoji_icons', function (Blueprint $table) {
            $table->id();
            $table->string('mood');
            $table->string('ref');
            $table->timestamps();
        });
        
        Schema::table('diaries', function (Blueprint $table) {
            $table->foreignId('emoji_icon_id')->references('id')->on('emoji_icons');
        });

        $emojis = [
            'HAPPY' => '128515',
            'RELIEVED' => '128524',
            'DELICIOUS' => '128523',
            'HEARTSHAPED' => '128525',
            'TEAROFJOY' => '128514',
            'TIRED' => '128555',
            'CONFUSED' => '128533',
            'DISAPPOINTED' => '128542',
            'ANGRY' => '128544',
            'CRYING' => '128557'
        ];

        // Add default roles in the roles table
        foreach ($emojis as $mood => $ref) {

            //Mass Assignment
            EmojiIcon::create([
                'mood' => $mood,
                'ref' => $ref,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns('diaries', ['emoji_icon_id']);
        Schema::dropIfExists('emoji_icons');
    }
}

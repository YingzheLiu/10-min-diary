<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'emoji_icon_id', 'user_id'];

    public function emojiIcon()
    {
        return $this->belongsTo(EmojiIcon::class);
    }
}

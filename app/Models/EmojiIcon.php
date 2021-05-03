<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmojiIcon extends Model
{
    use HasFactory;
    protected $fillable = ['mood', 'ref'];
}

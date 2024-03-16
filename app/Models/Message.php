<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public $table = "messages";

    protected $fillable = [
        'user_id',
        'conversation_id',
        'content'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function conversations()
    {
        return $this->hasMany(Conversations::class, 'conversation_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversations extends Model
{
    use HasFactory;
    public $table = 'conversations';

    public function participants()
    {
        return $this->hasMany(Participants::class, 'conversation_id', 'id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'participants');
    }

    public function messages()
    {
        return $this->hasMany(Message::class,  'conversation_id', 'id');
    }
}

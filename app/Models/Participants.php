<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participants extends Model
{
    use HasFactory;

    public $table = "participants";

    protected $fillable = [
        'conversation_id',
        'user_id'
    ];
    public function users() //LẤY RA USER
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }

    public function conversations() //lẤY RA CUỘC TRÒ CHUYÊN
    {
        return $this->belongsTo(Conversations::class, 'conversation_id', 'id');
    }
}

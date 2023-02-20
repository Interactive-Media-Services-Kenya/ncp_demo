<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectWinner extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function draws(){
        return $this->hasMany(Draw::class,'draw_id');
    }

    public function drawWinner(){
        return $this->belongsTo(DrawWinner::class, 'draw_winner_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'rejected_by');
    }
}

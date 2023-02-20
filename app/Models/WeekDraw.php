<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeekDraw extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function draws(){
        return $this->hasMany(Draw::class,'weekly_draw_id');
    }
}

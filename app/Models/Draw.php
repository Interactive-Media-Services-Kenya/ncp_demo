<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Draw extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function prizeType(){
        return $this->belongsTo(PrizeType::class, 'prize_type_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
    public function drawWinner(){
        return $this->hasOne(DrawWinner::class,'draw_id');
    }

}

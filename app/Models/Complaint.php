<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Complaint extends Model
{
    use HasFactory;
    use SoftDeletes;
    //protected $fillable = ['title','description','resolve_description','phone','company_id','level','status','created_at', 'updated_at', 'deleted_at'];
    protected $guarded = [];

    public function company(){
        return $this->belongsTo(Company::class);
    }


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

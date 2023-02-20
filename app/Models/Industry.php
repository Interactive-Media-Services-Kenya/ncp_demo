<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Industry extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
    ];

    public function company()
    {
        return $this->belongsToMany(Company::class);
    }

}

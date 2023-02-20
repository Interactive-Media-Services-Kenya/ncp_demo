<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'product_category_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class,'batch_id');
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

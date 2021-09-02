<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    protected $fillable = ['product_id','quantity','price'];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function propertyOptions() {
        return $this->belongsToMany(PropertyOption::class);
    }
    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['sku_id','text','grade','author_name','photos','active'];

    public function sku() {
        return $this->belongsTo(Sku::class);
    }

    public function scopeGetActive($query) {
        return $query->where('active','1');
    }

    public function getPhotosAttribute($value)
    {
//        dd($value);
        return unserialize($value);
    }

    public function getProductNameAttribute() {
        return Product::where('id',$this->sku->product->id)->first()->__('name');
    }

    use HasFactory;
}

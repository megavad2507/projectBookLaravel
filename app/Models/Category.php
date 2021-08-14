<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['code','name','description','picture'];
    public function products() {
        return $this->hasMany(Product::class);
    }
    use HasFactory;
}

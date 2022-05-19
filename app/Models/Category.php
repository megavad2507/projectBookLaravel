<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;
    protected $fillable = ['code','name','description','picture','name_en','description_en'];
    public function products($queryBuilder = false) {
        return $this->hasMany(Product::class);
    }
    public function adminFilterInputs() {
        return [
            'name' => [
                'name' => 'Название',
                'type' => 'text'
            ],
            'code' => [
                'name' => 'Код',
                'type' => 'text'
            ],
        ];
    }

    use HasFactory;
}

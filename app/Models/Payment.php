<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['name','name_en','description','description_en'];

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function adminFilterInputs() {
        return [
            'name' => [
                'name' => 'Название',
                'type' => 'text'
            ]
        ];
    }


    use HasFactory, Translatable;
}

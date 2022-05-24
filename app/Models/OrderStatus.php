<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $fillable = ['name','name_en','sort','description','description_en'];

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function adminFilterInputs() {
        return [
            'id' => [
                'name' => 'ID',
                'type' => 'text'
            ],
            'name' => [
                'name' => 'Название',
                'type' => 'text'
            ]
        ];
    }
    use HasFactory;
}

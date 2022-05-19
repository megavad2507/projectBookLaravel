<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyOption extends Model
{
    protected $fillable = ['property_id','name','name_en','code'];

    public function property() {
        return $this->belongsTo(Property::class);
    }
    public function skus() {
        return $this->belongsToMany(Sku::class,'sku_property_option');
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

    use HasFactory, SoftDeletes, Translatable;
}

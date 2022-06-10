<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['title','description','button_text','button_href','title_en','description_en','button_text_en','picture','hex'];
    use HasFactory, Translatable;
}

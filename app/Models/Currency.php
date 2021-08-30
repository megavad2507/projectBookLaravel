<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static byCode(\Illuminate\Contracts\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed $session)
 * @method static get()
 * @method static getCurrencies()
 */
class Currency extends Model
{
    protected $fillable = ['rate'];
    public function scopeByCode($query,$code) {
        return $query->where('code',$code);
    }

    /**
     * @return bool
     */
    public function isMain(): bool
    {
        return $this->is_main == 1;
    }
    use HasFactory;
}

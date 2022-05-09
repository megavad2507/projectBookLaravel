<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class Merchant extends Authenticatable
{
    protected $fillable = ['name','email','api_token'];

    public function updateToken() {
        while(true) {
            $token_no_hash = Str::random(60);
            $token = hash('sha256',$token_no_hash);
            $merchants = self::where('api_token',$token)->get();
            if($merchants->count() == 0) break;
        }
        $this->api_token = $token;
        $this->save();
        session()->flash('success','Сгенерированный token: '. $token_no_hash);
        return $token;
    }

    use HasFactory;
}

<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function editInfo() {
        $user = auth()->user();
        return view('auth.user.edit-info',compact('user'));
    }
    public function editInfoUpdate(UserRequest $request) {
        $params = $request->all();
        unset($params['password_confirmation']);
        if(is_null($params['password']))
            unset($params['password']);
        if(!empty($params['is_admin']))
            $params['is_admin'] = 1;
        else
            $params['is_admin'] = 0;
        if(!empty($params['password']))
            $params['password'] = Hash::make($params['password']);
        $user = auth()->user();
        $user->update($params);
        return redirect()->route('person.personal-info')->with('success','Данные успешно обновлены!');
    }
}

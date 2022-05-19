<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function add(Request $request,Sku $sku) {
        $validator = Validator::make($request->all(), [
            'text' => 'required|max:3000',
            'grade' => 'required|min:1|max:5',
            'author_name' => 'required|max:20',
            'photos.*' => 'mimes:jpg,bmp,png,mp4|max:10240',
            'photos' => 'max:3'
        ],[
            'photos.max' => 'Вы можете загрузить не более :max файлов',
        ]);

        if ($validator->fails()) {
//            return view('layouts.sku',[$sku->product->category->code,$sku->product->code,$sku->id])
            return redirect()->to(route('sku',[$sku->product->category->code,$sku->product->code,$sku->id]) . "#review_add_form")
                ->withErrors($validator)
                ->withInput()
                ;
            //можно сделать return view для ajax

        }
        $params = $request->all();
        if($request->hasfile('photos')) {
            $data = [];
            foreach($request->file('photos') as $photo)
            {
                $path = $photo->store('photoReviews');
                $data[] = $path;
            }
            $params['photos'] = serialize($data);
        }
        $params['active'] = 0;
        $params['sku_id'] = $sku->id;
        Review::create($params);
        return redirect()->to(route('sku',[$sku->product->category->code,$sku->product->code,$sku]). "#review_add_form")->with('success_add_review_message','Ваш отзыва появится после проверки менеджером!');
    }
}

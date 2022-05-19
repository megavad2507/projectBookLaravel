@extends('admin.app')
@section('title','Редактировать отзыв '.$review->name)
@section('content')
    <div class="col-md-12"><h1>Редактировать отзыв <b>{{ $review->id }}</b></h1>
        <form method="POST" enctype="multipart/form-data" action="{{ route('reviews.update',$review) }}">
            <div>
                @csrf
                @method('PUT')
                <div class="">
                    <label for="active" class="col-sm col-form-label">Проверен и одобрен менеджером: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'active'])
                        <input type="checkbox" class="form-control" name="active" id="active" {{ $review->active == 1 ? 'checked' : '' }}>
                    </div>
                </div>
                <div class="">
                    <label for="author_name" class="col-sm col-form-label">Товар: </label>
                    <div class="col-sm-6">
                        <a href="{{ route('sku',[$review->sku->product->category->code,$review->sku->product->code,$review->sku]) }}">{{ $review->product_name }}</a>
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="author_name" class="col-sm col-form-label">Автор комментария: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'author_name'])
                        <input type="text" class="form-control" name="author_name" id="author_name" value="{{ old('author_name',$review->author_name) }}">
                    </div>
                </div>
                <div class="">
                    <label for="text" class="col-sm col-form-label">Текст отзыва: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'text'])
                        <textarea name="text" id="" cols="50" rows="10">{{ old('text',$review->text) }}</textarea>
                    </div>
                </div>
                <div class="">
                    <label for="grade" class="col-sm col-form-label">Оценка: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'grade'])
                        <input type="number" min="1" max="5" name="grade" value="{{ old('text',$review->grade) }}">
                    </div>
                </div>
                <div class="">
                    <label for="attachments" class="col-sm col-form-label">Вложения: </label>
                    <div class="col-sm-6">
                        @if(!empty($review->attachments))
                            @foreach($review->attachments as $attachment)
                                @if($attachment['isPhoto'])
                                    <img src="{{ $attachment['path'] }}" alt="" style="max-width: 600px;max-height: 600px">
                                @else
                                    <video style="max-width: 300px;max-height: 300px" controls>
                                        <source src="{{ $attachment['path'] }}" type="{{ $attachment['mimeType'] }}">
                                    </video>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Сохранить</button>
            </div>

        </form>
    </div>
@endsection


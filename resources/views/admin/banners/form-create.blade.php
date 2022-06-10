@extends('admin.app')

@isset($banner)
    @section('title','Редактировать баннер '.$banner->title)
@else
    @section('title','Создать категорию')
@endisset
@section('content')
    <div class="col-md-12">
        @isset($banner)
            <h1>Редактировать баннер <b>{{ $banner->title }}</b></h1>
        @else
            <h1>Добавить баннер</h1>
        @endisset

        <form method="POST" enctype="multipart/form-data"
              @isset($banner)
                action="{{ route('banners.update',$banner) }}"
              @else
                action="{{ route('banners.store') }}"
              @endisset
        >
            <div>
                @csrf
                @isset($banner)
                    @method('PUT')
                @endisset
                <div class="">
                    <label for="code" class="col-sm col-form-label">Заголовок: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'title'])
                        <input type="text" class="form-control" name="title" id="title" value="{{ old('title', isset($banner) ? $banner->title : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="description" class="col-sm col-form-label">Текст баннера: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'description'])
                        <textarea name="description" id="description" cols="72" rows="7">{{ old('description', isset($banner) ? $banner->description : null) }}</textarea>
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Текст кнопки: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'button_text'])
                        <input type="text" class="form-control" name="button_text" id="button_text" value="{{ old('button_text', isset($banner) ? $banner->button_text : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Заголовок на английском: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'title_en'])
                        <input type="text" class="form-control" name="title_en" id="title_en" value="{{ old('title_en', isset($banner) ? $banner->title_en : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Описание на английском: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'description_en'])
                        <input type="text" class="form-control" name="description_en" id="description_en" value="{{ old('description_en', isset($banner) ? $banner->description_en : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Текст кнопки на английском: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'button_text_en'])
                        <input type="text" class="form-control" name="button_text_en" id="button_text_en" value="{{ old('button_text_en', isset($banner) ? $banner->description_en : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Ссылка на кнопке: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'button_href'])
                        <input type="text" class="form-control" name="button_href" id="button_href" value="{{ old('button_href', isset($banner) ? $banner->button_href : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Цвет текста описания: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'hex'])
                        <input type="text" class="form-control" name="hex" id="hex" value="{{ old('hex', isset($banner) ? $banner->hex : null) }}">
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="picture" class="col-sm col-form-label">Картинка: </label>
                    <div class="col-sm-10">
                        <label for="picture" class="btn btn-secondary">
                            Загрузить <input type="file" style="display: none" name="picture" id="picture">
                        </label>
                    </div>
                </div>
                <button class="btn btn-success">Сохранить</button>
            </div>

        </form>
    </div>
@endsection


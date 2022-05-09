@extends('admin.app')
@section('title','Просмотр баннера '.$banner->title)
@section('content')
    <h1>Баннер {{ $banner->title }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Поле</th>
                <th>Значение</th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $banner->id }}</td>
            </tr>
            <tr>
                <td>Заголовок</td>
                <td>{{ $banner->title }}</td>
            </tr>
            <tr>
                <td>Описание</td>
                <td>{{ $banner->description }}</td>
            </tr>
            <tr>
                <td>Текст кнопки</td>
                <td>{{ $banner->button_text }}</td>
            </tr>
            <tr>
                <td>Заголовок на английском</td>
                <td>{{ $banner->title_en }}</td>
            </tr>
            <tr>
                <td>Описание на английском</td>
                <td>{{ $banner->description_en }}</td>
            </tr>
            <tr>
                <td>Текст кнопки на английском</td>
                <td>{{ $banner->button_text_en }}</td>
            </tr>
            @isset($banner->button_href)
                <tr>
                    <td>Ссылка на кнопке</td>
                    <td>{{ $banner->button_href }}</td>
                </tr>
            @endisset
            @isset($banner->picture)
                <tr>
                    <td>Картинка</td>
                    <td><img src="{{ Storage::url($banner->picture) }}" alt="{{ $banner->title }}" height="240px"></td>
                </tr>
            @endisset
        </thead>
    </table>
@endsection

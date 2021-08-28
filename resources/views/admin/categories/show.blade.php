@extends('admin.app')
@section('title','Изменить категорию '.$category->name)
@section('content')
    <h1>Категория {{ $category->name }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Поле</th>
                <th>Значение</th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $category->id }}</td>
            </tr>
            <tr>
                <td>Код</td>
                <td>{{ $category->code }}</td>
            </tr>
            <tr>
                <td>Название</td>
                <td>{{ $category->name }}</td>
            </tr>
            <tr>
                <td>Название на английском</td>
                <td>{{ $category->name_en }}</td>
            </tr>
            <tr>
                <td>Описание</td>
                <td>{{ $category->description }}</td>
            </tr>
            <tr>
                <td>Описание на английском</td>
                <td>{{ $category->description_en }}</td>
            </tr>
            @isset($category->picture)
                <tr>
                    <td>Картинка</td>
                    <td><img src="{{ Storage::url($category->picture) }}" alt="{{ $category->name }}" height="240px"></td>
                </tr>
            @endisset
            <tr>
                <td>Количество товаров</td>
                <td>{{ $category->products->count() }}</td>
            </tr>
        </thead>
    </table>
@endsection

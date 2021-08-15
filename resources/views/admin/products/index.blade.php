@extends('admin.app')
@section('title','Товары')
@section('content')
    <div class="col-md-12">
        <h1>Товары</h1>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Код</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Категория</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('products.destroy',$product) }}" method="POST">
                                <a type="button" href="{{ route('products.show',$product) }}" class="btn btn-success">Открыть</a>
                                <a type="button" href="{{ route('products.edit',$product) }}" class="btn btn-warning">Редактировать</a>
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger" value="Удалить">
                                @csrf
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('products.create') }}" class="btn btn-success" type="button">Добавить товар</a>
    </div>
@endsection

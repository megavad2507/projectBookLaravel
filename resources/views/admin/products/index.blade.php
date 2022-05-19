@extends('admin.app')
@section('title','Товары')
@section('content')
    <div class="col-md-12">
        <h1>Товары</h1>
        <table class="table">
            @include('admin.layouts.admin_filter',['class' => new \App\Models\Product()])
            <thead>
            <tr>
                <th>#</th>
                <th>Код</th>
                <th>Название</th>
                <th style="width:20px">Кол-во ТП</th>
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
                    <td style="width:20px">{{ $product->skus->count() }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('products.destroy',$product) }}" method="POST">
                                <a type="button" href="{{ route('products.show',$product) }}" class="btn btn-success">Открыть</a>
                                <a type="button" href="{{ route('skus.index',$product) }}" class="btn btn-success">SKU</a>
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
    {{ $products->withQueryString()->links() }}
@endsection

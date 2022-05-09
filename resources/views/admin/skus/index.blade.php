@extends('admin.app')
@section('title','Товарные предложения ' .$product->name)
@section('content')
    <div class="col-md-12">
        <h1>Товарные предложения {{ $product->name }}</h1>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Товарное предложение(свойства)</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
                @foreach($skus as $sku)
                    <tr>
                        <td>{{ $sku->id }}</td>
                        <td>
                            {{ $product->name . ' ' . $sku->propertyOptions->map->name->implode(', ') }}
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{ route('skus.destroy',[$product,$sku]) }}" method="POST">
                                    <a type="button" href="{{ route('skus.show',[$product,$sku]) }}" class="btn btn-success">Открыть</a>
                                    <a type="button" href="{{ route('skus.edit',[$product,$sku]) }}" class="btn btn-warning">Редактировать</a>
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
        <a href="{{ route('skus.create',[$product]) }}" class="btn btn-success" type="button">Добавить торговое предложение</a>
    </div>
    {{ $skus->links() }}
@endsection

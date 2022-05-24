@extends('admin.app')
@section('title','Статусы заказа')
@section('content')
    <div class="col-md-12">
        <h1>Статусы заказа</h1>
        <table class="table">
            @include('admin.layouts.admin_filter',['class' => new \App\Models\OrderStatus()])
            <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Сортировка</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($statuses as $status)
                <tr>
                    <td>{{ $status->id }}</td>
                    <td>{{ $status->name }}</td>
                    <td>{{ $status->sort }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('order_statuses.destroy',$status) }}" method="POST">
                                <a type="button" href="{{ route('order_statuses.show',$status) }}" class="btn btn-success">Открыть</a>
                                <a type="button" href="{{ route('order_statuses.edit',$status) }}" class="btn btn-warning">Редактировать</a>
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
        <a href="{{ route('order_statuses.create') }}" class="btn btn-success" type="button">Добавить способ оплаты</a>

    </div>
    {{ $statuses->withQueryString()->links() }}
@endsection

@extends('admin.app')
@section('title','Поставщики')
@section('content')
    <div class="col-md-12">
        <h1>Поставщики</h1>
        @if(session()->has('success'))
            <p class="alert alert-success">{{ session()->get('success') }}</p>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
                @foreach($merchants as $merchant)
                    <tr>
                        <td>{{ $merchant->id }}</td>
                        <td>{{ $merchant->name }}</td>
                        <td>{{ $merchant->email }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{ route('merchants.destroy',$merchant) }}" method="POST">
                                    <a type="button" href="{{ route('merchants.show',$merchant) }}" class="btn btn-success">Открыть</a>
                                    <a type="button" href="{{ route('merchants.edit',$merchant) }}" class="btn btn-warning">Редактировать</a>
                                    <a type="button" href="{{ route('merchants.update_token',$merchant) }}" class="btn btn-primary ">Обновить токен</a>
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
        <a href="{{ route('merchants.create') }}" class="btn btn-success" type="button">Добавить поставщика</a>
    </div>
    {{ $merchants->links() }}
@endsection

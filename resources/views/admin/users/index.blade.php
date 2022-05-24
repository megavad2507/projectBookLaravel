@extends('admin.app')
@section('title','Пользователи')
@section('content')
    <div class="col-md-12">
        <h1>Пользователи</h1>
        <table class="table">
            @include('admin.layouts.admin_filter',['class' => new \App\Models\User()])

            <thead>
            <tr>
                <th>#</th>
                <th>Имя</th>
                <th>Почта</th>
                <th>Администратор</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_admin ? 'Да' : 'Нет' }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{ route('users.destroy',[$user]) }}" method="POST">
                                    <a type="button" href="{{ route('users.show',[$user]) }}" class="btn btn-success">Открыть</a>
                                    <a type="button" href="{{ route('users.edit',[$user]) }}" class="btn btn-warning">Редактировать</a>
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
        <a href="{{ route('users.create') }}" class="btn btn-success" type="button">Добавить нового пользователя</a>
    </div>
    {{ $users->withQueryString()->links() }}
@endsection

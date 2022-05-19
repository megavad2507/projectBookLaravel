@extends('admin.app')
@section('title','Категории')
@section('content')
    <div class="col-md-12">
        <h1>Категории</h1>
        <table class="table">
            @include('admin.layouts.admin_filter',['class' => new \App\Models\Category()])

            <thead>
            <tr>
                <th>#</th>
                <th>Код</th>
                <th>Название</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->code }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{ route('categories.destroy',$category) }}" method="POST">
                                    <a type="button" href="{{ route('categories.show',$category) }}" class="btn btn-success">Открыть</a>
                                    <a type="button" href="{{ route('categories.edit',$category) }}" class="btn btn-warning">Редактировать</a>
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
        <a href="{{ route('categories.create') }}" class="btn btn-success" type="button">Добавить категорию </a>
    </div>
    {{ $categories->withQueryString()->links() }}
@endsection

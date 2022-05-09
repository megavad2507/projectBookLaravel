@extends('admin.app')
@section('title','Баннеры на главной')
@section('content')
    <div class="col-md-12">
        <h1>Баннеры на главной</h1>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Заголовок</th>
                <th>Картинка</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
                @foreach($banners as $banner)
                    <tr>
                        <td>{{ $banner->id }}</td>
                        <td>{{ $banner->title }}</td>
                        <td><img src="{{ Storage::url($banner->picture) }}" alt="{{ $banner->title }}" width="250px" height="150px"></td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{ route('banners.destroy',$banner) }}" method="POST">
                                    <a type="button" href="{{ route('banners.show',$banner) }}" class="btn btn-success">Открыть</a>
                                    <a type="button" href="{{ route('banners.edit',$banner) }}" class="btn btn-warning">Редактировать</a>
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
        <a href="{{ route('banners.create') }}" class="btn btn-success" type="button">Добавить Баннер</a>
    </div>
    {{ $banners->links() }}
@endsection

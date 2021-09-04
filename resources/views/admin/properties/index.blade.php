@extends('admin.app')
@section('title','Свойства')
@section('content')
    <div class="col-md-12">
        <h1>Свойства</h1>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
                @foreach($properties as $property)
                    <tr>
                        <td>{{ $property->id }}</td>
                        <td>{{ $property->name }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{ route('properties.destroy',$property) }}" method="POST">
                                    <a type="button" href="{{ route('properties.show',$property) }}" class="btn btn-success">Открыть</a>
                                    <a type="button" href="{{ route('properties.edit',$property) }}" class="btn btn-warning">Редактировать</a>
                                    <a type="button" href="{{ route('property_options.index',$property) }}" class="btn btn-primary">Значения свойства</a>
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
        <a href="{{ route('properties.create') }}" class="btn btn-success" type="button">Добавить свойство </a>
    </div>
    {{ $properties->links() }}
@endsection

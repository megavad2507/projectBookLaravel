@extends('admin.app')
@section('title','Варианты свойств ' . $property->name)
@section('content')
    <div class="col-md-12">
        <h1>Варианты свойств {{ $property->name }}</h1>
        <table class="table">
            @include('admin.layouts.admin_filter',['class' => new \App\Models\PropertyOption()])

            <thead>
            <tr>
                <th>#</th>
                <th>Название варианта</th>
                <th>Код варианта</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
                @foreach($propertyOptions as $propertyOption)
                    <tr>
                        <td>{{ $propertyOption->id }}</td>
                        <td>{{ $propertyOption->name }}</td>
                        <td>{{ $propertyOption->code }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{ route('property_options.destroy',[$property,$propertyOption]) }}" method="POST">
                                    <a type="button" href="{{ route('property_options.show',[$property,$propertyOption]) }}" class="btn btn-success">Открыть</a>
                                    <a type="button" href="{{ route('property_options.edit',[$property,$propertyOption]) }}" class="btn btn-warning">Редактировать</a>
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
        <a href="{{ route('property_options.create',$property) }}" class="btn btn-success" type="button">Добавить вариант свойства</a>
    </div>
    {{ $propertyOptions->withQueryString()->links() }}
@endsection

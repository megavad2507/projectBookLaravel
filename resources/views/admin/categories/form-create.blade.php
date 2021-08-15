@extends('admin.app')

@isset($category)
    @section('title','Редактировать категорию '.$category->name)
@else
    @section('title','Создать категорию')
@endisset
@section('content')
    <div class="col-md-12">
        @isset($category)
            <h1>Редактировать категорию <b>{{ $category->name }}</b></h1>
        @else
            <h1>Добавить категорию</h1>
        @endisset

        <form method="POST" enctype="multipart/form-data"
              @isset($category)
                action="{{ route('categories.update',$category) }}"
              @else
                action="{{ route('categories.store') }}"
              @endisset
        >
            <div>
                @csrf
                @isset($category)
                    @method('PUT')
                @endisset
                <div class="">
                    <label for="code" class="col-sm col-form-label">Код: </label>
                    <div class="col-sm-6">
                        @error('code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" class="form-control" name="code" id="code" value="{{ old('code', isset($category) ? $category->code : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Название: </label>
                    <div class="col-sm-6">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', isset($category) ? $category->name : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="description" class="col-sm col-form-label">Описание: </label>
                    <div class="col-sm-6">
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <textarea name="description" id="description" cols="72" rows="7">{{ old('description', isset($category) ? $category->description : null) }}</textarea>
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="picture" class="col-sm col-form-label">Картинка: </label>
                    <div class="col-sm-10">
                        <label for="picture" class="btn btn-secondary">
                            Загрузить <input type="file" style="display: none" name="picture" id="picture">
                        </label>
                    </div>
                </div>
                <button class="btn btn-success">Сохранить</button>
            </div>

        </form>
    </div>
@endsection


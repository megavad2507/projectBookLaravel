@extends('admin.app')
@section('title','Отзывы')
@section('content')
    <div class="col-md-12">
        <h1>Отзывы</h1>
        <table class="table">
            <form action="{{ route('reviews.index') }}" method="GET">
                <label for="only_inactive">Показывать только неактивные</label>
                <input id="only_inactive" type="checkbox" name="only_inactive" style="margin: 0 20px"
                       @if(request()->get('only_inactive') == 'on')
                           checked
                       @endif
                >
                <button class="btn btn-success">Применить</button>
            </form>
            <thead>
            <tr>
                <th>#</th>
                <th>Товар</th>
                <th>Автор отзыва</th>
                <th>Дата отзыва</th>
                <th>Проверен модератором</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
                @foreach($reviews as $review)
                    <tr>
                        <td>{{ $review->id }}</td>
                        <td>{{ $review->product_name }}</td>
                        <td>{{ $review->author_name }}</td>
                        <td>{{ Carbon\Carbon::createFromDate($review->created_at)->format('d.m.y') }}</td>
                        <td>{{ $review->active == 1 ? 'Да' : 'Нет' }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{ route('reviews.destroy',$review) }}" method="POST">
                                    <a type="button" href="{{ route('reviews.edit',$review) }}" class="btn btn-warning">Редактировать</a>
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
    </div>
    {{ $reviews->links() }}
@endsection

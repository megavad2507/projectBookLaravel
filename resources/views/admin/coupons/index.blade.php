@extends('admin.app')
@section('title','Купоны')
@section('content')
    <div class="col-md-12">
        <h1>Купоны</h1>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Код</th>
                <th>Тип</th>
                <th>Дата окончания</th>
                <th>Описание</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->id }}</td>
                    <td>{{ $coupon->code }}</td>
                    <td>{{ $coupon->type }}</td>
                    <td>{{ $coupon->expired_at->format('d.m.Y') }}</td>
                    <td>{{ $coupon->description }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('coupons.destroy',$coupon) }}" method="POST">
                                <a type="button" href="{{ route('coupons.show',$coupon) }}" class="btn btn-success">Открыть</a>
                                <a type="button" href="{{ route('coupons.edit',$coupon) }}" class="btn btn-warning">Редактировать</a>
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
        <a href="{{ route('coupons.create') }}" class="btn btn-success" type="button">Добавить купон</a>

    </div>
    {{ $coupons->links() }}
@endsection

@extends('admin.app')
@section('title','Способы оплаты')
@section('content')
    <div class="col-md-12">
        <h1>Способы оплаты</h1>
        <table class="table">
            @include('admin.layouts.admin_filter',['class' => new \App\Models\Payment()])
            <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->name }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('payments.destroy',$payment) }}" method="POST">
                                <a type="button" href="{{ route('payments.show',$payment) }}" class="btn btn-success">Открыть</a>
                                <a type="button" href="{{ route('payments.edit',$payment) }}" class="btn btn-warning">Редактировать</a>
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
        <a href="{{ route('payments.create') }}" class="btn btn-success" type="button">Добавить способ оплаты</a>

    </div>
    {{ $payments->withQueryString()->links() }}
@endsection

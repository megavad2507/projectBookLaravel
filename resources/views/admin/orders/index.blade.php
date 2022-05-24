@extends('admin.app')
@section('content')
    <div class="col-md-12">
        <h1>Заказы</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Имя
                </th>
                <th>
                    Телефон
                </th>
                <th>
                    Дата создания
                </th>
                <th>
                    Статус
                </th>
                <th>
                    Способ оплаты
                </th>
                <th>
                    Сумма
                </th>
                <th>
                    Действия
                </th>
            </tr>
            </tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->created_at->format('H:m d.m.y') }}</td>
                    <td>{{ $order->status->name }}</td>
                    <td>{{ $order->payment->name }}</td>
                    <td>{{ $order->sum }} {{ $order->currency->symbol }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a type="button" class="btn btn-success"
                               @ifAdmin
                                    href="{{ route('orders.show',$order) }}"
                               @else
                                   href="{{ route('person.orders.show',$order) }}"
                               @endifAdmin
                           >Открыть</a>
                        </div>
                        @ifAdmin
                        <a type="button" href="{{route('orders.edit',$order)}}" class="btn btn-warning">Редактировать</a>
                        @endifAdmin
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $orders->links() }}
    </div>
@endsection

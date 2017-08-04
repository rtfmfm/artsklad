@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (empty($orders[0]))
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col col-md-8 col-md-offset-2">
                                <div class="alert alert-info text-center" role="alert">
                                    <h2>Все още нямате направени поръчки</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col col-md-6">
                        <h2>
                            Поръчки
                        </h2>
                    </div>
                </div>
                <div>
                    <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Поръчки</div>
                    <!-- Table -->
                    <table class="table">
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Номер на поръчка
                            </th>
                            <th>
                                Дата
                            </th>
                            <th>
                                Клиент
                            </th>
                            <th class="text-center">
                                Преглед
                            </th>
                            <th class="text-center">
                                Изтриване
                            </th>
                        </tr>
                        @foreach ($orders as $key => $order)
                            <tr>
                                <td>
                                    <strong>
                                        {{$key + 1}}
                                    </strong>
                                </td>
                                <td>
                                    {{ $order->id }}
                                </td>
                                <td>
                                    {{ date_format($order->created_at, 'd.m.Y') }}
                                </td>
                                <td>
                                    {{ $order->user->name }}
                                </td>
                                <td class="text-center">
                                    <a href="{{route('orders.show', $order->id)}}" class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                                <td class="text-center">
                                    <form method="post" action="/orders/{{$order->id }}" onsubmit="ConfirmDelete()">
                                        {{ method_field('DELETE') }}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="btn btn-danger btn-xs" type="submit">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

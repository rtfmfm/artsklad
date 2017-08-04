@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col col-md-12">
                    <h2>
                        Информация за поръчка №{{ $order->id }} | {{ date_format($order->created_at, 'd.m.Y') }} | {{ $order->user->name }}
                    </h2>
                <hr>
                    <h4>
                        Продукти: <b>{{ $products_count }}</b> | 
                        Артикули: <b>{{ $articles_qty }}</b> | 
                        Обща сума: <b>{{ number_format($old_amount,2,"."," ") }}</b>
                    </h4>
                </div>
            </div>
            <div>
                @foreach ($order_rows as $key => $product)
                    <div class="panel panel-default">
                        <div class="panel-body row">
                            <div class="col-md-10 titletext strong">
                                <strong>
                                    {{$key + 1}}
                                </strong>. 
                                    {{ $product->name }}
                            </div>
                            <div class="col-md-2 text-right">
                                <span class="titletext">Количество: </span>
                                {{ $product->qty}}
                                <hr class="thinhr">
                            </div>
                            <div class="col-md-4">
                                <span class="titletext">Бренд: </span>
                                {{$product->produser}}
                            </div>
                            <div class="col-md-2">
                                <span class="titletext">Арт: </span>
                                {{$product->art}}
                            </div>
                            <div class="col-md-1">
                                <span class="titletext">Упак: </span>
                                {{$product->fasovka}}
                            </div>
                            <div class="col-md-1">
                                <span class="titletext">За: </span>
                                {{$product->unit}}
                            </div>
                            <div class="col-md-2">
                                <span class="titletext">Цена: </span>
                                {{ $product->price }}
                            </div>
                            <div class="col-md-2 text-right">
                                <span class="titletext">Сума: </span>
                                {{ number_format($product->price*$product->qty,2,"."," ") }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="btn btn-info" href="{{ URL::previous() }}">Назад</a>
        </div>
    </div>
</div>
@endsection

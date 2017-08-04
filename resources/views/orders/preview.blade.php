@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (empty($carts[0]))
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col col-md-8 col-md-offset-2">
                                <div class="alert alert-info text-center" role="alert">
                                    <h2>Кoличката ви е празна</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col col-md-6">
                        <h2>
                            Продукти в кошницата
                        </h2>
                        <h4>
                            Продукти: <b>{{ $products_count }}</b> | 
                            Артикули: <b>{{ $articles_qty }}</b> | 
                            Обща сума: <b>{{ number_format($old_amount,2,"."," ") }}</b>
                        </h4>
                    </div>
                    <div class="col col-md-6 text-right" style="margin-top: 8px;">
                        <a href="{{url('createorder')}}" class="btn btn-success confirm-order-btn">
                            <span style="padding: 0 15px;">
                                Потвърди поръчката
                            </span>
                        </a>
                    </div>
                </div>
                <div>
                    @foreach ($carts as $key => $product)
                        <div class="panel panel-default">
                            <div class="panel-body row">
                                <div class="col-md-9 titletext strong">
                                    <strong>
                                        {{$key + 1}}
                                    </strong>. 
                                    <a href="{{url('products', $product->id)}}">
                                        {{ $product->product->name }}
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <form role="form" method="POST" action="{{url('/carts')}}">
                                        {{ csrf_field() }}
                                        <div class="input-group">
                                            <input type="hidden" name="id" value="{{$product->product->id}}">
                                            <input type="number" class="form-control" name="qty" value="{{ $product->qty ?: old('qty') }}" min="1">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="submit">
                                                    <i class="fa fa-refresh fa-lg" aria-hidden="true"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </form>            
                                </div>
                                <div class="col-md-1 right-text">
                                    <form method="post" action="/carts/{{$product->id }}" onsubmit="ConfirmDelete()">
                                        {{ method_field('DELETE') }}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="btn btn-danger" type="submit">
                                            <i class="fa fa-trash fa-lg" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-12">
                                    <span class="titletext">Бренд: </span>
                                    {{$product->product->produser}}
                                    <hr class="thinhr">
                                </div>
                                <div class="col-md-2">
                                    <span class="titletext">Арт: </span>
                                    {{$product->product->art}}
                                </div>
                                <div class="col-md-2">
                                    <span class="titletext">Упак: </span>
                                    {{$product->product->fasovka}}
                                </div>
                                <div class="col-md-2">
                                    <span class="titletext">За: </span>
                                    {{$product->product->unit}}
                                </div>
                                <div class="col-md-2">
                                    <span class="titletext">Цена: </span>
                                    {{ $product->product->price }}
                                </div>
                                <div class="col-md-3 text-right">
                                    <span class="titletext">Сума: </span>
                                    {{ number_format($product->product->price*$product->qty,2,"."," ") }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

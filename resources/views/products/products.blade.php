@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
                <div id="sidebar">
                    @include('layouts/sidebar')
                </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading"><Strong>Продукти - {{$main_category}}</Strong></div>
                <div class="panel-body" id="products">
                    @foreach ( $products as $product )

<div class="panel panel-default">
    <div class="panel-body row">
        <div class="col-md-10 product-left">
            <div class="row">
            <div class="col-md-9 titletext strong"><a href="{{url('products', $product->id)}}">{{ $product->name }}</a></div>
            <div class="col-md-3 text-right"><span class="titletext">Цена: </span>{{ $product->price }}</div>
            </div>
            <div class="row">
        {{-- {{dump($product)}} --}}
            <small>
                <div class="col-md-3"><span class="titletext">Арт:</span> {{$product->art}}</div>    
                <div class="col-md-5"><span class="titletext">Бренд:</span> {{$product->produser}}</div>
                <div class="col-md-2"><span class="titletext">Упак:</span> {{$product->fasovka}}</div>
                <div class="col-md-2 text-right"><span class="titletext">За:</span> {{$product->unit}}</div>
            </small>
            </div>
        </div>
        <div class="col-md-2">
            <form role="form" method="POST" action="{{url('/carts')}}">
            {{ csrf_field() }}
                <div class="input-group">
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <input type="number" min="1" class="form-control" name="qty" value="{{ $product->ordered ?: old('qty') }}" min="0">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i></button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</div>

@endsection

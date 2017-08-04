@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>{{$product->name}}</h3></div>
                <div class="panel-body" id="product_description">
        <div class="row">
            <div class="col-md-12">
                <span class="titletext">Бренд:</span> {{$product->produser}}<hr>
            </div>
        </div>
        <div class="row">
        <div class="col-md-2"><span class="titletext">Арт:</span> {{$product->art}}</div>
        <div class="col-md-2"><span class="titletext">Упак:</span> {{$product->fasovka}}</div>
        <div class="col-md-2"><span class="titletext">За:</span> {{$product->unit}}</div>
        <div class="col-md-2"><span class="titletext">Цена: </span>{{ $product->price }}</div>
        </div>
        <hr>
        <h4>Описание:</h4>
                </div>
            </div>
<a class="btn btn-info" href="{{ URL::previous() }}">Назад</a>

        </div>
    </div>
</div>
@endsection

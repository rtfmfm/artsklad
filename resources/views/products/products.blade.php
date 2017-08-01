@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading"><Strong>Products - {{$main_category}}</Strong></div>

                <div class="panel-body" id="products">
                    @foreach ( $products as $product )
                        <div class="{{$product->produser}}">{{ $product->name }} / {{$product->produser}}</div>
                    @endforeach

                </div>
            </div>
            {{ $products->links() }}
        </div>
    </div>
</div>

@endsection

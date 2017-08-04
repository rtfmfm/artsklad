@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading"><Strong>Categories</Strong></div>

                <div class="panel-body" id="products">
                    @foreach ( $categories as $category )
                        <a href="{{ route('categories', $category->groop1) }}" class="btn btn-default" style="margin: 5px;">{{ $category->groop1 }}</a>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

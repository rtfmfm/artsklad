<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">

    <link href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr/toastr.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
{!! Toastr::message() !!}

    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            {{-- <li><a href="{{ route('register') }}">Register</a></li> --}}
                        @else
                            <li>
                                <a href="{{ route('home')}}">Категории</a>
                            </li>
                            <li>
                                <a class="cart_qty" href="{{route('preview')}}"><i class="fa fa-shopping-cart fa-lg"></i>
                                <span id="cardqty">
                                @if(session()->has('cart_items')){{session()->get('cart_items')}} @endif
                                </span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

<div class="col col-md-9">
    <div class="content">
        @yield('content')
    </div>
</div>

<div id="loading" class="loadingmsg"><h1>Loading...</h1></div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/toastr.js') }}"></script>



</div>
<script>
$("#filters").on('submit', function(e) {
   e.preventDefault();
   var data = $(this).serialize();
   $("#loading").show();
   $.post(
      'http://dev.akrozia.org/products/filters/ajax-division',
       data,
        function(data) {
           $('#products').empty();
           $.each(data, function(index, prodObject) {
               $('#products').append('<div class="panel panel-default"><div class="panel-body row"><div class="col-md-10 product-left"><div class="row"><div class="col-md-9 titletext strong"><a href="/products/'+ prodObject.id +'">' + prodObject.name + '</a></div><div class="col-md-3 text-right"><span class="titletext">Цена: </span>' + prodObject.price + '</div></div><div class="row"><small><div class="col-md-3"><span class="titletext">Арт:</span> ' + prodObject.art + '</div><div class="col-md-5"><span class="titletext">Бренд:</span> ' + prodObject.produser + '</div><div class="col-md-2"><span class="titletext">Упак:</span> ' + prodObject.fasovka + '</div><div class="col-md-2 text-right"><span class="titletext">За:</span> ' + prodObject.unit + '</div></small></div></div><div class="col-md-2"><form role="form" method="POST" action="{{url('/carts')}}">{{ csrf_field() }}<div class="input-group"><input type="hidden" name="id" value="' + prodObject.id + '"><input type="number" min="1" class="form-control" name="qty" value="' + prodObject.ordered + '" min="0"><span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i></button></span></div></form></div></div></div>');
           });
       }).always(function(){ $('#loading').hide() });
});
$("#filters input:checkbox").on('change', function(e){$("#filters").trigger('submit');});

  function ConfirmDelete()
  {
  var x = confirm("Записът ще бъде изтрит!");
    if (x)
        return true;
    else
        event.preventDefault();
        return false;
  }


  @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif
  
(function($){
window.onbeforeunload = function(e){    
window.name += ' [' + $(window).scrollTop().toString() + '[' + $(window).scrollLeft().toString();
};
$.maintainscroll = function() {
if(window.name.indexOf('[') > 0)
{
var parts = window.name.split('['); 
window.name = $.trim(parts[0]);
window.scrollTo(parseInt(parts[parts.length - 1]), parseInt(parts[parts.length - 2]));
}   
};  
$.maintainscroll();
})(jQuery);

</script>

</body>
</html>

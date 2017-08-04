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
               $('#products').append('<div class="panel panel-default"><div class="panel-body row"><div class="col-md-10 product-left"><div class="row"><div class="col-md-9 titletext strong">' + prodObject.name + '</div><div class="col-md-3 text-right"><span class="titletext">Цена: </span>' + prodObject.price + '</div></div><div class="row"><small><div class="col-md-3"><span class="titletext">Арт: </span>' + prodObject.art + '</div><div class="col-md-5"><span class="titletext">Бренд: </span>' + prodObject.produser + '</div><div class="col-md-2"><span class="titletext">Упак: </span>' + prodObject.fasovka + '</div><div class="col-md-2 text-right"><span class="titletext">За: </span>' + prodObject.unit + '</div></small></div></div><div class="col-md-2"><form role="form" method="POST" action="{{url('/temporders')}}">{{ csrf_field() }}<input type="hidden" name="id" value="' + prodObject.id + '"><div class="input-group"><input min="1" type="number" class="form-control" name="qty" value="{{ old('qty') }}"><span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-cart-plus fa-lg" aria-hidden="true"></i></button></span></div></form></div></div></div>');
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
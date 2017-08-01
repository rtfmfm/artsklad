<form id="filters" name="filters" novalidate="novalidate" role="form" method="POST" action="{{ url('') }}">
{{ csrf_field() }}

<div class="panel-group">
  	<div class="panel panel-default">
    	<div class="panel-heading panel-heading-bg">
      		<h4 class="panel-title">
        		<a data-toggle="collapse" href="#collapse1"><strong>Producers</strong></a>
      		</h4>
    	</div>
 
	    	<div id="collapse1" class="panel-collapse">
	    	<div class="panel-body fixed-panel">
					@foreach ( $produsers as $produser )
						<li>
							<label>
								<input type="checkbox" name="checkbox" value="{{$produser->produser}}" @if(session()->has('filters_'.$produser->produser)) checked @endif> {{ $produser->produser }}
							</label>
						</li>
					@endforeach
				</div>
	    	</div>
  	</div>
</div>
<div class="panel-group">
  	<div class="panel panel-default">
    	<div class="panel-heading panel-heading-bg">
      		<h4 class="panel-title">
        		<a data-toggle="collapse" href="#collapse1"><strong>Categories</strong></a>
      		</h4>
    	</div>
 
	    	<div id="collapse2" class="panel-collapse">
	    	<div class="panel-body fixed-panel">
					@foreach ( $categories as $category )
						<li>
							<label>
								<input type="checkbox" name="checkbox" value="{{$category->groop2}}" @if(session()->has('filters_'.$category->groop2)) checked @endif> {{ $category->groop2 }}
							</label>
						</li>
					@endforeach
				</div>
	    	</div>
  	</div>
</div>


</form>





@extends('base')

@section('main')

<div class="nav topnav">
	<div>
  		<a style="margin: 5px;" href="/" class="btn btn-info">Home</a>
		<a style="margin: 5px;" href="/products" class="btn btn-info">Products</a>
		<a style="margin: 5px;" href="/recipes" class="btn btn-info active">Recipes</a>
  	</div>   
</div>


<div class="row">	
	<div class="col-sm-8">
		<br>
		<br>
		<div>
			<h1 style="text-align: center; color: #0050a"><b>{{$recipe->recipe_name}}</b></h1>
		</div>
		<div>
			<h4 style="margin-top: 70px; text-align: center; color: purple;"><b>Execution</b></h4>
		</div>
		<div>
			<h4 style="margin-top: 70px; text-align: center; color: purple;"><b>Ingredients:</b></h4>
		</div>
		<div>
			<ul class="list-group">
				@foreach ($ingredients as $ingredient)
					<li style="text-align: center; margin-bottom: 5px;" class="list-group-item">
						{{ $ingredient->ingredient_name }}: {{ $ingredient->qty}} Kg/L
					</li>
				@endforeach
			</ul>
		</div>
		
		<div>
			<ul class=list-group>
			<li style="text-align: center; margin-bottom: 45px;" class=list-group-item>{{ $recipe->execution }}</li>
			</ul>
		</div>
		<br>
		<br>
	
	</div>	
</div>

@endsection

@extends('base')

@section('main')


<div class="nav topnav">
	<div>
		<a style="margin: 5px;" href="/products" class="btn btn-info">Products</a>
		<a style="margin: 5px;" href="/recipes" class="btn btn-info active">Recipes</a>
  	</div>   
</div>

<div class="col-sm-12">
	<br>
  	@if(session()->get('success'))
		<div class="alert alert-success">
	  		{{ session()->get('success') }} 
    	</div>
  	@endif
</div>


<div class="row">	
	<div class="col-sm-8" >
		<br>
		<br>
		<div>
			<a style="width: auto; margin-left:40%; " href="{{ route('recipes.create')}}" class="btn btn-success">Add New Recipe</a>  	
		</div>
		<br>
		<br>
				
		<input 	type="text" size="30" id="search_box" onkeyup="search_box()" placeholder="Search for recipes.."
				style="border: 1px solid blue; color: purple; font-size: 13px; border-radius:20px; text-align: center;">

		<table class="table table-striped table-bordered table-hover table-sm table-dark text-center" id="recipes_table">
			<thead class="text-center" >
				<tr>
					<th class="text-center" scope="col">
					  	<b>Name</b>
						<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_i_DfXCW6TIqhqYKDvOodMlmfBnO77TefTg&usqp=CAU" 
							 style="height: 10px; width:15px; display: inline;">
					</th>
					<th class="text-center" scope="col">Ingredients</th>
					<th scope="col" colspan="2" style="text-align:center;"></td>
				</tr>
			</thead>
			<tbody id="recipes" class="text-center">
				@foreach($recipes as $recipe)
					<tr class="text-center">
						<td class="text-center">
							<a style="text-align: center;" href="{{ route('recipes.show',$recipe->recipe_id)}}">{{$recipe->recipe_name }}</a>
						</td>
						<td>
							<input class="iButton" type="button" value="See Ingredients" style="{display:block;}">
							<div class="container" style="display:none;width:200px;height: auto;">
								@foreach($items as $item)
										<?php 
											if ($item->recipe == $recipe->recipe_id)
												echo '<li list-style-type="lower-greek" style="color: purple;">'.$item->ingredient_name.': '.$item->qty.'</li>';
										?>
								@endforeach	
							</div>							
						</td>
						<td>
							<a href="{{ route('recipes.edit',$recipe->recipe_id)}}" style="text-align: center;" class="btn btn-primary">Edit</a>
						</td>
						<td>
							<form action="{{ route('recipes.destroy', $recipe->recipe_id)}}" method="post">
								@csrf
              					@method('DELETE')
								<button class="btn btn-danger" type="submit" style="text-align: center;" >Delete</button>
              				</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>	
	</div>
</div>





<!-- Search bar-->
<script>
	function search_box() {
  		let input, filter, tr, td, i, txtValue;
  		input = document.getElementById('search_box');
  		filter = input.value.toUpperCase();
  		tbody = document.getElementById("recipes");
  		tr = tbody.getElementsByTagName('tr');
		

  
  		for (i = 0; i < tr.length; i++) {
    		td = tr[i].getElementsByTagName("td")[0];
    		txtValue = td.textContent || td.innerText;

    		if (txtValue.toUpperCase().indexOf(filter) > -1 )
      			tr[i].style.display = "";
    		else
      			tr[i].style.display = "none";
		}
	}
</script>

<!-- Ingridients Button -->
<script>
	$('.iButton').click(function(){
    	if ( this.value === 'Hide Ingredients' ) {
       	open = false;
      	  this.value = 'See Ingredients';
      	  $(this).next("div.container").hide(4);
    	}
    		else {
     	   open = true;
     	   this.value = 'Hide Ingredients';
      	  $(this).siblings("[value='Hide Ingredients']").click();
     	   $(this).next("div.container").show(4);
    	}
	});
</script>

@endsection

<br>
<br>

<div class="topnav">
  	<div >
		<a style="margin: 5px;" href="/products" class="btn btn-info active">Products</a>
  		<a style="margin: 5px;" href="/recipes" class="btn btn-info">Recipes</a>
  	</div>   
</div>

<!-- This obviously needs some improvements..-->
<table class="table">
  <thead>
    <tr>
      <th scope="col">Available Recipes</th>
    </tr>
  </thead>
  <tbody>

    @foreach($items as $item)
      <tr>
        <th scope="row"> <a href="recipes/<?php echo $item->recipe_id; ?>">{{$item->recipe_name}}</a></th>
      </tr>
    @endforeach

  </tbody>
</table>

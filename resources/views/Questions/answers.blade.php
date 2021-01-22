<br>
<br>

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

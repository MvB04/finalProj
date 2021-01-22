<br>
<br>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Available Recipes</th>
    </tr>
  </thead>
  <tbody>

    @foreach($items  as $item)
      <tr>
        <th scope="row"> <a href="#">{{$item}}</a></th>
      </tr>
    @endforeach

  </tbody>
</table>

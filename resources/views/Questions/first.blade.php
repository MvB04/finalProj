<form action="{{ route('CreateQuestion.store') }}" method="post">

  @csrf
  <div class="form-group">
    <label for="1stquestion">Show recipes containing the following ingredient: </label>
    <input type="text" class="form-control" id="ingredient" name="ingredient" placeholder="ingredient">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>

  

</form>

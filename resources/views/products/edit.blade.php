@extends('base')

@section('main')


<div class="topnav">
  <div >
  	<a style="margin: 5px;" href="/" class="btn btn-info">Home</a>
	  <a style="margin: 5px;" href="/products" class="btn btn-info active">Products</a>
  	<a style="margin: 5px;" href="/recipes" class="btn btn-info">Recipes</a>
  </div>   
</div>


<div class="row">
    <div class="col-sm-4 col-md-offset-4">

        <h1 class="display-3" style="text-align:center;">Update a product</h1>
		
        @if ($errors->any())
        	<div class="alert alert-danger">
            	<ul>
                	@foreach ($errors->all() as $error)
                		<li>{{ $error }}</li>
                	@endforeach
            	</ul>
        	</div>
        	<br/>
        @endif

		<form method="post" action="{{ route('products.update', $product->product_id) }}">
            @method('PATCH')
            @csrf

			<div class="form-group"	>    
            <label for="product_name">Product Name:</label><br/>
            	<input type="text" class="form-control" name="product_name" value="{{$product->product_name}}"/>
       		 </div>
		    
       		 <div class="form-group" >    
            	<label for="exp_date">Expiration Date:</label><br/>
            	<input type="date" class="form-control" name="exp_date" value="{{$product->exp_date}}"/>
        	</div>
        	<div class="form-group" >    
           		<label for="qty">Quantity</label><br/>
           		<input type="number" step="1" min=0 class="form-control" name="qty" value="{{$product->qty}}"/>
       		 </div>
       		 <div class="form-group" >    
           		 <label for="weight">Weight (in Kg / L) </label><br/>
    	    	<input type="number" step="0.001" min=0 class="form-control" name="weight" value="{{$product->weight}}"/>
        	</div>
	    	<div class="form-group" >    
           		 <label for="type">Details</label><br/>
            	<input type="text" size="40" maxlength="120" class="form-control" name="details" value="{{$product->details}}" />
        	</div>
			<br>
            <button type="submit" class="btn btn-success" style="margin-left:40%; margin-right:50%; margin-top:15px;  margin-bottom:5%;">
				Update
			</button>
        </form>
    </div>
</div>
@endsection

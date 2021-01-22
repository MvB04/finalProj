<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;



class QuestionController extends Controller
{

  	public function index(Request $request)
  	{
		
		$item=Request()->get('ingredient');

		$ingredients = DB::table('ingredients')
        	->where('ingredient_name', 'like', $item)
            ->get();

    	$items = array();
		
 		foreach($ingredients as $ingredient){
			$recipe = DB::table('recipes')
            	->where('recipe_id', $ingredient->recipe)
				->distinct()
				->get();
			$items[] = $recipe[0];
		}

    	return view('Questions.answers', ['items' => $items]);
  	}

	public function update()
  	{

  	}

}

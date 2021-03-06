<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

 /*
 * An important note about validation (store & update methods):
 * 
 * Laravel does not provide a 'double' type for validation.
 * However, we want 'price' and 'weight' fields of a Product to be doubles.
 * So to provide this functionality, we use a regex.
 * (This happens in the validation arrays of the store and update methods)
 * 
 * TODO: this regex is not complete. It accepts double values that 
 * 		 have more than one '.' if these extra dots are at the end of 
 * 		 the string.
 * 
 */

class RecipeController extends Controller
{

   /** Display a listing of the resource. */
    public function index()
    {
		$items = DB::table('recipes')
					->join('ingredients', 'recipes.recipe_id', '=', 'ingredients.recipe')
					->select('recipe_name', 'execution', 'ingredient_name', 'qty', 'recipe')
					->get();
		$recipes = DB::table('recipes')
					->orderBy('recipe_name')
					->get();
		return view('recipes.index', ['items' => $items, 'recipes' => $recipes]);
    }

    /** Show the form for creating a new resource. */
    public function create()
    {
        return view('recipes.create');
    }

    /** Store a newly created resource in storage. 
	 * 
	 * The regex for the price and weight fields (double) is probably enough
	 * A double input on these fields, e.g. 0.25 for weight,  means 250 gr, 
	 * and we inform the user about it.
     */
    public function store(Request $request)
    {	
		// Save the recipe, without ingredients.
		// We do this first as we need it's id for the ingredient table.
        $request->validate([
			'recipe_name'	=> 'required', 
			'execution'		=> 'required'
		]);
        $recipe = new Recipe([
			'recipe_name'	=> $request->get('recipe_name'), 
			'execution'		=> $request->get('execution')
        ]);
		$recipe->save();
		
		
		// Next we save the ingredients of the recipe.
		// For every ingredient of the request, we
		// create a new ingredient entry in our table, 
		// save it's name and qty based on request, 
		// and associate it's foreign key recipe_id with the recipe 
		// we saved earlier.
		$counter = 0;
		while($request->has('recipeIngredients'.strval($counter))  &&
			  $request->has('recipeIngredientQty'.strval($counter)))	{
			
			$request->validate([
				'recipeIngredients'.strval($counter) => 'required', 
				'recipeIngredientQty'.strval($counter) => 'required|regex:/^\d+(\.\d{1,3})?$/'
			]);
			
			$ingredient = new Ingredient([
				'ingredient_name' => $request->get('recipeIngredients'.strval($counter)), 
				'qty' => $request->get('recipeIngredientQty'.strval($counter)), 
				'recipe' => $recipe->recipe_id
			]);
			
			$ingredient->save();
			$counter++;
		}

        return redirect('/recipes')->with('success', 'recipe saved!');
    }

	
	/** Display the specified resource. */
    public function show($id)
    {
		$recipe = Recipe::find($id);
		$ingredients = DB::table('ingredients')
					->select('ingredient_name', 'qty')
					->where('recipe', '=', $recipe->recipe_id)
					->get();
		return view('recipes.show', ['ingredients' => $ingredients, 'recipe' => $recipe]);
    }

	
	/** Show the form for editing the specified resource. */
    public function edit($id)
    {
		$recipe = Recipe::find($id);
		$ingredients = DB::table('ingredients')
					->where('recipe', '=', $recipe->recipe_id)
					->get();
        return view('recipes.edit', ['ingredients' => $ingredients, 'recipe' => $recipe]);
    }


	/** Update the specified resource in storage. */
    public function update(Request $request, $id)
    {
        $request->validate([
			'recipe_name'	=> 'required', 
			'execution'		=> 'required'
		]);

		$recipe = Recipe::find($id);
		$recipe->recipe_name = $request->get('recipe_name');
		$recipe->execution	 = $request->get('execution');
		$recipe->save();
		
		// Delete all the ingredients the old recipe had.
		$ingredients = DB::table('ingredients')->where('recipe', '=', $id)->get();
		foreach ($ingredients as $ingredient)	{
			$ingredient = Ingredient::find($ingredient->ingredient_id);
			$ingredient->delete();
		}

		// Insert the new ingredients of the recipe (as in store())
		$counter = 0;
		while($request->has('recipeIngredients'.strval($counter))  &&
			  $request->has('recipeIngredientQty'.strval($counter)))	{
			
			$request->validate([
				'recipeIngredients'.strval($counter) => 'required', 
				'recipeIngredientQty'.strval($counter) => 'required|regex:/^\d+(\.\d{1,3})?$/'
			]);
			
			$ingredient = new Ingredient([
				'ingredient_name' => $request->get('recipeIngredients'.strval($counter)), 
				'qty' => $request->get('recipeIngredientQty'.strval($counter)), 
				'recipe' => $recipe->recipe_id
			]);
			
			$ingredient->save();
			$counter++;
		}

        return redirect('/recipes')->with('success', 'recipe updated!');
    }

	
	/** Removes a recipes AND its corresponding ingredients from the database. */
    public function destroy($id)
    {
		// In our migration file, we declare the 'recipe' foreign key
		// of the table ingredients in a way that when a recipe is removed, 
		// all it's ingredients will be removed too. (onDelete('CASCADE')).
		// This is why the next two commands are enough.
        $recipe = Recipe::find($id);
        $recipe->delete();
        return redirect('/recipes')->with('success', 'recipe deleted!');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 	This table holds the ingredients for the recipes. 
 *  Normally, every ingredient can be used by more than
 *  one recipes, but we don't implement this functionality.
 * 	Instead, for each recipe we store in this table it's 
 *  ingredients through the RecipeController. 
 * 	So if there are 4 recipes that use 1 onion as an 
 *  ingredient, this table will have 4 entries. The only 
 *  different field for these entries will be the recipe
 *  that they are used in, which is expressed with a foreign 
 *  key that pinpoints to the recipes table. 
 *  
 *  We could somehow improve all of this by using a oneToMany 
 *  relation, but what we have to do is already too complicated
 *  based on our experience with this Framework and/or php.
 */

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->increments('ingredient_id');
			$table->timestamps();
			$table->string('ingredient_name');
			$table->string('qty')->nullable();
			$table->integer('recipe')->unsigned();
			$table->foreign('recipe')->references('recipe_id')->on('recipes')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredients');
    }
}

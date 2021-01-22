<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*	Every recipe needs it's ingredients. 
	But since not all recipes need the same number of 
	ingredients, we have created another table called ingredients 
	to store them. Nothing unusual here, everything is self-explanatory.
*/

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
			$table->increments('recipe_id');
			$table->timestamps();			
			$table->string('recipe_name');
			$table->longText('execution');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}

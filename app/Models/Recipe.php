<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Recipe extends Model
{
	protected $primaryKey = 'recipe_id';
	
	// guarded prevents mass-assignment on these fields.
	// Naturally, we want to protect our id from this effect
    protected $guarded = ['recipe_id'];
    protected $fillable = [
		'recipe_name', 
		'execution', 
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Ingredient extends Model
{
	protected $primaryKey = 'ingredient_id';
	
	// guarded prevents mass-assignment on these fields.
	// Naturally, we want to protect our id from this effect
    protected $guarded = ['ingredient_id'];
    protected $fillable = [
		'ingredient_name', 
		'recipe', 
		'qty',
    ];
}

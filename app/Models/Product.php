<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



/*
	qty:
* This is different from the qty field in the Ingredient Model
* It represents how many of this product the user has.

	weight:
* How much every 1 qty of this product weights in kg/L
* Is a double.
* A double value means gr/ml (see also qty field of Ingredient Model.)
*/


class Product extends Model
{
	protected $primaryKey = 'product_id';
	
	// guarded prevents mass-assignment on these fields.
	// Naturally, we want to protect our id from this effect
    protected $guarded = ['product_id'];
    protected $fillable = [
		'product_name', 
		'exp_date',  
		'qty',
		'weight',
		'details'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'order_id',
        'art',
        'name',
        'produser',
        'unit',
        'category',
        'fasovka',
        'price',
        'qty',
	];
    protected $table = 'products';

}          
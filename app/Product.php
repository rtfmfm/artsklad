<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'art',
        'name',
        'produser',
        'country',
        'unit',
        'price',
        'groop1',
        'groop2',
        'groop3',
        'groop4',
        'groop5',
        'fasovka',
        'qty',
        'min_qty',
        'text',
        'sclad',
        'source_id',
	];
    protected $table = 'products';

}          
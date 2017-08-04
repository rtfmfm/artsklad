<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $fillable = [
        'user_id',
        'product_id',
        'qty',
	];
    protected $table = 'carts';


    public function user() {
            return $this->belongsTo('App\User');
    }

    public function product() {
            return $this->belongsTo('App\Product');
    }

}          
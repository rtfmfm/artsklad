<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'client_id',
        'status',

	];
    protected $table = 'orders';

    public function user() {
            return $this->belongsTo('App\User', 'client_id');
    }

}          
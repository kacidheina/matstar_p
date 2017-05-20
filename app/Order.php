<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = 'orders';

    public function creator()
    {
        return $this->belongsTo('App\User', 'user_create_id');
    }

    public function modifier()
    {
        return $this->belongsTo('App\User', 'user_modify_id');
    }

    public function client()
    {
        return $this->belongsTo('App\Client', 'id_client');
    }

    public function orderItems()
    {
        return $this->hasMany('App\Order_Item', 'id_order');
    }


    public function product_variation()
    {
        return $this->hasManyThrough(
            'App\Order_Item', 'App\Product_Variation',
            'id_order', 'id_product_variation', 'id'
        );
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Item extends Model
{
    public $table = 'order_items';

    public function variation()
    {return $this->belongsTo('App\Product_Variation', 'id_product_variation' );}

    public function order()
    {return $this->belongsTo('App\Order', 'id_order' );}

    public function creator()
    {return $this->belongsTo('App\User', 'user_create_id' );}

    public function modifier()
    {return $this->belongsTo('App\User', 'user_modify_id' );}

}

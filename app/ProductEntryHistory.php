<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ProductEntryHistory extends Model
{
    public $table = 'product_entry_history';


    public function productVariations()
    {return $this->hasMany('App\Product_Variation', 'id_entry' );}

    public function product()
    {return $this->belongsTo('App\Product', 'id_product' );}

    public function creator()
    {return $this->belongsTo('App\User', 'user_create_id' );}

    public function modifier()
    {return $this->belongsTo('App\User', 'user_modify_id' );}
}

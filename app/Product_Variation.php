<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Product_Variation extends Model
{
    public $table = 'product_variations';
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('delete', function (Builder $builder) {
            $builder->where('delete', '=', 'no');
        });
    }

    public function color()
    {return $this->belongsTo('App\Color', 'id_color' );}

    public function product()
    {return $this->belongsTo('App\Product', 'id_product' );}

    public function entry()
    {return $this->belongsTo('App\ProductEntryHistory', 'id_entry');}

    public function creator()
    {return $this->belongsTo('App\User', 'user_create_id' );}

    public function modifier()
    {return $this->belongsTo('App\User', 'user_modify_id' );}

}
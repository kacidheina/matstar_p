<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Product extends Model
{

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


    public function creator()
    {
        return $this->belongsTo('App\User', 'user_create_id');
    }

    public function modifier()
    {
        return $this->belongsTo('App\User', 'user_modify_id');
    }

    public function entries()
    {
        return $this->hasMany('App\ProductEntryHistory', 'id_product');
    }

    public function variations()
    {
        return $this->hasMany('App\Product_Variation', 'id_product');
    }


    public function category()
    {
        return $this->belongsTo('App\Category', 'id_category');
    }
}

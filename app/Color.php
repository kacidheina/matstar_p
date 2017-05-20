<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Color extends Model
{


    public $table = 'colors';
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

    public function products()
    {
        return $this->hasMany('App\Product_Variation', 'id_product');
    }

    public function nrProducts()
    {
        $number = count($this->products());
        return $number;
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'user_create_id');
    }

    public function modifier()
    {
        return $this->belongsTo('App\User', 'user_modify_id');
    }
}

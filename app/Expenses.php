<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Expenses extends Model
{
    public $table = 'expenses';

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
}

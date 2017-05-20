<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Story_Clients_Debts extends Model
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

    public $table = 'story_clients_debts';

    public function creator()
    {
        return $this->belongsTo('App\User', 'user_create_id');
    }

    public function modifier()
    {
        return $this->belongsTo('App\User', 'user_modify_id');
    }
}

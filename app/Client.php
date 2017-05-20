<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function creator()
    {
        return $this->belongsTo('App\User', 'user_create_id');
    }

    public function modifier()
    {
        return $this->belongsTo('App\User', 'user_modify_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Order', 'id_client');
    }


}

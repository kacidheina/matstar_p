<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function debit()
    {
        return $this->hasMany('App\Debit','id_client');
    }
}

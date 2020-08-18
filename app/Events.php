<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id_event';
    protected $fillable = [
        'id_users', 'name'
    ];


    public function companies()
    {
        return $this->hasOne('App\User', 'id_user');
    }
}

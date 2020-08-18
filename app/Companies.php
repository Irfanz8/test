<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    protected $table = 'companies';
    protected $primaryKey = 'id_companies';
    protected $fillable = [
        'name'
    ];


    public function companies()
    {
        return $this->hasOne('App\User', 'id_companies');
    }
}

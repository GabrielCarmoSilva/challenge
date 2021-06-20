<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['user_id', 'agency', 'number', 'digit', 'type', 'name', 'cpf', 'social_reason', 'fantasy_name', 'cnpj'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}

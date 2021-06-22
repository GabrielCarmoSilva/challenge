<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['balance', 'user_id', 'agency', 'number', 'digit', 'type', 'name', 'cpf', 'social_reason', 'fantasy_name', 'cnpj'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function transactions() {
        return $this->hasMany('App\Transaction');
    }
}

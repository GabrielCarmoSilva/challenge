<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['value', 'type', 'account_id'];

    public function account() {
        return $this->belongsTo('App\Account');
    }
}

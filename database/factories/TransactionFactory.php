<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transaction;
use App\Account;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    $accounts = Account::all()->pluck('id')->toArray();
    return [
        'type' => 'Transferência',
        'value' => $faker->randomFloat(),
        'account_id' => $accounts[rand(0, (count($accounts) - 1))]
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\User;
use App\Account;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'agency' => $faker->randomNumber($nbDigits = 4),
        'number' => $faker->randomNumber($nbDigits = 8),
        'digit' => $faker->randomDigit(),
        'type' => 'Pessoal', 
        'name' => $faker->name,
        'cpf' => rand(00000000001, 99999999999),
        'social_reason' => null,
        'fantasy_name' => null,
        'cnpj' => null,
        'balance' => 0,
        'user_id' => $faker->unique()->numberBetween(1, 5)
    ];
});

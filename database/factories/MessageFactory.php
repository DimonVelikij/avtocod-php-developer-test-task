<?php

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

/*
|--------------------------------------------------------------------------
| Message Factory
|--------------------------------------------------------------------------
|
| Вставка сообщений пользователей
|
*/

/** @var EloquentFactory $factory */
$factory->define(\App\Models\Message::class, function (Faker $faker) {
    return [
        'text'      =>  $faker->text,
        'user_id'   =>  factory(\App\Models\User::class)->create()->id
    ];
});

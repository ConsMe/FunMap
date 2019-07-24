<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Point;
use Faker\Generator as Faker;

$factory->define(Point::class, function (Faker $faker) {
    return [
        'lat_lng' => json_encode([mt_rand(39, 76), mt_rand(26, 233)]),
        'comment' => $faker->realText(40)
    ];
});

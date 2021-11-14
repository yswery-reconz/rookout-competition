<?php

use Illuminate\Support\Str;
use Faker\Factory as Faker;

function random2DArrayWithToken($token)
{
    $faker = Faker::create();
    $randomArray = [];

    $randLevel = rand(1, 3);
    $randIndex = rand(1, 10);

    foreach (range(1, 3) as $firstIndex =>  $firstLevelIndex) {
        foreach (range(1, 10) as $index) {
            if ($firstLevelIndex == $randLevel && $index == $randIndex) {
                $randomArray[$firstIndex][] = ['secret_token' => $token];
            } else {
                $randomArray[$firstIndex][] = ['name' => $faker->name];
            }
        }
    }

    return $randomArray;
}
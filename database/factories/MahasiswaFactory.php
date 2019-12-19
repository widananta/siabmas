<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// use App\Model;
use Faker\Generator as Faker;

$factory->define(App\mahasiswa::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'nama' => $faker->name,
        'nim' => $faker->numberBetween($min = 10000000000, 19999999999),
        'jenis_kelamin' => $faker->randomElement($array = array('l', 'p')),
        'kelas' => 'Sistem Informasi:16',
        'alamat' => $faker->address,
        'no_telp' => '08'.$faker->numberBetween($min = 1000000000, 9999999999),
    ];
});

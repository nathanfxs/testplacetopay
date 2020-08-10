<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        //
        'description' => 'Camiseta Negra',
        
        'customer_name' => $faker->name,
        'customer_document_type' => 'CC',
        'customer_document' => $faker->randomNumber,
        'customer_country' => 'CO',
        'customer_city' => 'Medellin',
        'customer_province' => 'Antioquia', 
        'customer_street' => $faker->streetAddress,
        'customer_postal_code' => $faker->postcode,
        'customer_phone' => $faker->phoneNumber,
        'customer_mobile' => $faker->phoneNumber,
        'customer_email' => $faker->unique()->safeEmail,
        'status' => $faker->randomElement(['CREATED', 'PAYED','REJECTED']),
        'created_at'=> now(),
        'updated_at'=> now(),
        'amount' => $faker->numberBetween(5000,10000),
        'request_id_placetopay' => 0
    ];
});

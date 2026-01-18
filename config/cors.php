<?php


return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'], // Define the paths to include for CORS

    'allowed_methods' => ['*'], // Allow all methods or you can define specific ones like 'GET', 'POST', etc.

     'allowed_origins' => [
        'http://localhost:3000', // Replace with your frontend URL
        'http://localhost:3001', // Replace with your frontend URL
        'http://localhost:8080', // Replace with your frontend URL


        'https://admin.imranuzzaman.com',
        'https://imranuzzaman.com',
        'http://imran-api.test',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Allow all headers or specify the ones you need

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true, // Allow credentials
];

<?php


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the API',
        'version' => '1.0.0',
        'status' => 'success',
        'developer' => 'Md Enzamamul Haque ShipLu',
        'developer_email' => 'me@shiplujs.com',
        'developer_url' => 'https://shiplujs.com',
    ]);
});

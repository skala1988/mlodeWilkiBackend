<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MyHttpController;

Route::post('/login', function (Request $request) {
    $loginCtr = new LoginController();
    $result = $loginCtr->login($request);
    return MyHttpController::createResponse(
        $result, 
        $result ? true : 401, 
        $result ? [] : ['Wrong email or password. Try again.']
    );
});

Route::get('/logout', function (Request $request) {
    $loginCtr = new LoginController();
    $loginCtr->logout($request);
    return MyHttpController::createResponse(true);
});

Route::get('/checkLogged', function() {
    $loginCtr = new LoginController();
    return MyHttpController::createResponse($loginCtr->checkLogged());
});

Route::get('/token', function() {
    return MyHttpController::createResponse(csrf_token());
});

<?php
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MyHttpController;

Route::post('/login', function (Request $request) {
    $loginCtr = new LoginController();
    $result = $loginCtr->login($request);
    $resultCode = $result === 1 ? true : 401;
    
    $errors = Array();
    if($result === 2) {
        $errors[]='Wrong email or password. Try again.';
    }
    if($result === 3) {
        // Controlled by ThrottleRequestOverride class
        // $errors[]='Too many attempts. Try again later.';
    }
    // $result == 1 - ok
    // $result == 2 - wrong data
    // $result == 3 - too many attempts
    return MyHttpController::createResponse($result, $resultCode, $errors);
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

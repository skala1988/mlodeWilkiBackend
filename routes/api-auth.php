<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::match(['options'], '/token')->middleware('cors');

Route::post('/login', function (Request $request) {
    $loginCtr = new LoginController();
    $result = $loginCtr->login($request);
    return $result ? 'true' : 'false';
});

Route::get('/logout', function (Request $request) {
    $loginCtr = new LoginController();
    if($loginCtr->logout($request)) {
        return 'true';
    } else {
        return 'false';
    }
});

Route::get('/checkLogged', function() {
    $loginCtr = new LoginController();
    var_dump($loginCtr->checkLogged());
});

Route::get('/token', function() {
   return json_encode(csrf_token()); 
});

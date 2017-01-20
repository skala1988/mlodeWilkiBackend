<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class MyHttpController extends Controller
{
    public function __construct() {}
    static function createResponse($data, $status = true, $errors = Array()) {
        $responseStr = json_encode((Object)Array(
            'data' => $data,
            'status' => $status === true,
            'errors' =>  $errors
        ));
        
        return Response($responseStr, $status!==true ? $status : 200);
    }
}
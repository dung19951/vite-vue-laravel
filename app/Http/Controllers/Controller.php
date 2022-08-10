<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Enums\StatusCode;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function resolve($data){
        if(!$data){
            $data=[];
        }
        return response()->json([
            'success'=>true,
            'data'=>$data,
            'errors'=>[]
        ],StatusCode::OK);
    }

    public function reject($errors){
        if(!$errors){
            $errors=[];
        }
        return response()->json([
            'success'=>false,
            'data'=>[],
            'errors'=>$errors
        ],StatusCode::BAD_REQUEST);
    }
}

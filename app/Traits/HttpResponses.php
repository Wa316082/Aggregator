<?php
namespace App\Traits;
trait HttpResponses
{


    protected function success(string $message='', $data, $code = 200){
        return response()->json([
            'status'=>true,
            'message'=>$message,
            'data'=> $data

        ], $code);

    }



    protected function error($message, $code=400){
        return response()->json([
            'status'=>false,
            'message'=>$message,

        ], $code);

    }



}

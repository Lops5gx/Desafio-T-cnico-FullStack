<?php

namespace App\Utils;

class Utils 
{

    const STATUS_CODE_200 = 200;
    const STATUS_CODE_400 = 400;

    public static function defaultReturn(mixed $data){
        return response()->json([
            'data' => $data,
        ]);
    }
}
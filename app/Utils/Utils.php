<?php

namespace App\Utils;

class Utils 
{

    const STATUS_CODE_200 = 200;
    const STATUS_CODE_400 = 400;


     /**
    * Default application return 
    * @param Mixed $data
    * @return $response
   */
    public static function defaultReturn(mixed $data){
        return response($data, self::STATUS_CODE_200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']);
    }
}
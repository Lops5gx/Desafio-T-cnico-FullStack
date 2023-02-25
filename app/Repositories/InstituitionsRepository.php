<?php

namespace App\Repositories;

use App\Interfaces\InstituitionsInterface;

class InstituitionsRepository implements InstituitionsInterface
{

    public function getInstituitions(){
        return \File::get(storage_path("app/public/files/instituicoes.json"));
    }   

}
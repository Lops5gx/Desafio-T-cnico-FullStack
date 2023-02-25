<?php

namespace App\Repositories;

use App\Interfaces\InstituitionsInterface;

class InstituitionsRepository implements InstituitionsInterface
{

    public function getInstituitions(){
        return ['instituições'];
    }   

}
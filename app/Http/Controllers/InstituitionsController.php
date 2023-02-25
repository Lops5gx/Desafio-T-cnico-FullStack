<?php

namespace App\Http\Controllers;

use App\Http\Requests\Instituition\Index;
use App\Interfaces\InstituitionsInterface;
use App\Utils\Utils;

class InstituitionsController extends Controller
{
    private $instituitions;

    /**
    * @param InstituitionsInterface $instituitions
    * @return Void
   */
    public function __Construct(InstituitionsInterface $instituitions){
        $this->instituitions = $instituitions;
    }

    /**
    * Get all instituitions
    * @param Index $request
    * @return response
   */
    public function Index(Index $request){

        try{
            $data = $this->instituitions->getInstituitions();
            return Utils::defaultReturn($data);

        }catch(\Exception $error){
            return Utils::defaultReturn($error->getMessage());
        }

    }
}

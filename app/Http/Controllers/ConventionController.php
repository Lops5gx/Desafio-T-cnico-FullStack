<?php

namespace App\Http\Controllers;

use App\Http\Requests\Convention\Index;
use App\Interfaces\ConventionInterface;
use App\Utils\Utils;

class ConventionController extends Controller
{
    private $convention;

    /**
    * @param ConventionInterface $convention
    * @return Void
   */
    public function __Construct(ConventionInterface $convention){
        $this->convention = $convention;
    }

   /**
    * Get all conventions
    * @param Index $request
    * @return response
   */
    public function Index(Index $request){

        try{
            $data = $this->convention->getConventions();
            return Utils::defaultReturn($data);
            
        }catch(\Exception $error){
            return Utils::defaultReturn($error->getMessage());
            
        }

    }
}

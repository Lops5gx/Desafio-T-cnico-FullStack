<?php

namespace App\Http\Controllers;

use App\Http\Requests\Simulation\Store;
use App\Interfaces\SimulationInterface;
use App\Utils\Utils;

class SimulationController extends Controller
{
    private $simulation;

    /**
    * @param SimulationInterface $simulation
    * @return Void
   */
    public function __Construct(SimulationInterface $simulation){
        $this->simulation = $simulation;
    }

    /**
    * Simulate taxes for instituitions and their conventions
    * @param Store $request
    * @return response
   */
    public function simulate(Store $request){

        try{
            $loanValue    = $request->valor_emprestimo;
            $convention   = $request->convenios;
            $instituition = $request->instituicoes;
            $instalment   = $request->parcela;

            $data = $this->simulation->init($loanValue, $convention, $instituition, $instalment);
            
            return Utils::defaultReturn($data);

        }catch(\Exception $error){
            return Utils::defaultReturn($error->getMessage());
        }

    }
}

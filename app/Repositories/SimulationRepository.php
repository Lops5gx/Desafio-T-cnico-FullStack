<?php
namespace App\Repositories;

use App\Interfaces\SimulationInterface;

class SimulationRepository implements SimulationInterface{

    private $Instituitionstaxes;

    /**
    * Start the calculations of taxes to all instituitions and their conventions
    * @param Float $loanValue
    * @param Array|Null $convention
    * @param Array|Null $instituition
    * @param Int|Null $instalment
    * @return Array $result
   */
    public function init(float $loanValue, array $convention = null, array $instituition = null, int $instalment = null){

        $this->Instituitionstaxes = $this->getInstituitionstaxes();
        $result = $this->startCalculation($loanValue, $convention, $instituition, $instalment);

        return $result;

    }

     /**
    * Calculate the taxes to all instituitions and their conventions
    * @param Float $loanValue
    * @param Array|Null $convention
    * @param Array|Null $instituition
    * @param Int|Null $instalment
    * @return Array $result
   */
    private function startCalculation(float $loanValue, array $convention = null, array $instituition = null, int $instalment = null){
        $result = [];
        
        foreach ($this->Instituitionstaxes as $taxes) {
            $result[$taxes->instituicao][] = [
                "taxa"            => $taxes->taxaJuros,
                "parcelas"        => $instalment ? $instalment : $taxes->parcelas,
                "valor_parcela"   => round($loanValue * $taxes->coeficiente, 2),
                "convenio"        => $taxes->convenio,
            ];                
        }
        return $result;
    }

     /**
    * Get all Instituitions Taxes
    * @return Array $result
   */
    private function getInstituitionstaxes(){
        return json_decode(\File::get(storage_path("app/public/files/taxas_instituicoes.json")));
    }
}
<?php
namespace App\Repositories;

use App\Interfaces\SimulationInterface;

class SimulationRepository implements SimulationInterface{

    private $Instituitionstaxes;
    private $simulation = [];
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
    * @return $result
   */
    private function startCalculation(float $loanValue, array $convention = null, array $instituition = null, int $instalment = null){
        $result = [];

        foreach ($this->Instituitionstaxes as $taxes) {
            $result[$taxes->instituicao][] = [
                "taxa"            => $taxes->taxaJuros,
                "parcelas"        => $taxes->parcelas,
                "valor_parcela"   => round($loanValue * $taxes->coeficiente, 2),
                "convenio"        => $taxes->convenio,
            ];                
        }

        $result = $this->filterInstituition($instituition, $result);
        $result = $this->filterByConvention($convention, $result);
        $result = $this->filterByInstalment($instalment, $result);
        
        dd($result);
        return $result;
    }

      /**
    * Filter by Instituition
    * @param Array|Null $instituitions
    * @param Mixed $result
    * @return $result
   */
    private function filterInstituition(array $instituitions, mixed $dataFiltered){
        if (\count($instituitions))
        {
            $arrayAux = [];
            foreach ($instituitions AS $key => $instituition)
            {
                if (\array_key_exists($instituition, $dataFiltered))
                {
                     $arrayAux[$instituition] = $dataFiltered[$instituition];
                }
            }
            $dataFiltered = $arrayAux;
        }
        return $dataFiltered;
    }

     /**
    * Filter by convention
    * @param Array|Null $convention
    * @param Mixed $dataFiltered
    * @return Array $result
   */
    private function filterByConvention(array $conventions, mixed $dataFiltered){

        $arrayAux = [];

        foreach ($dataFiltered as $chavePrimaria => $taxes) {
            foreach ($taxes as $data) {
                foreach ($conventions as $key => $convention) {
                    if($data['convenio'] == $convention){
                        $arrayAux[$chavePrimaria][] = $data;

                    }
                }
            }
        }
        return $arrayAux;
    }

     /**
    * Filter by instalment
    * @param Array|Null $instalment
    * @param Mixed $dataFiltered
    * @return Array $result
   */
    private function filterByInstalment(int $instalment, mixed $dataFiltered){
        $result = [];

        foreach ($dataFiltered as $chavePrimaria => $taxes) {
            foreach ($taxes as $data) {
                if($data['parcelas'] == $instalment){
                    $result[$chavePrimaria][] = $data;
                }
            }
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
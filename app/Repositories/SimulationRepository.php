<?php
namespace App\Repositories;

use App\Interfaces\SimulationInterface;

class SimulationRepository implements SimulationInterface{

    private $Instituitionstaxes;

    public function init(float $loanValue, array $convention = null, array $instituition = null, int $instalment = null){

        $this->Instituitionstaxes = $this->getInstituitionstaxes();
        $result = $this->startCalculation($loanValue, $convention, $instituition, $instalment);

        return $result;

    }

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

    private function getInstituitionstaxes(){
        return json_decode(\File::get(storage_path("app/public/files/taxas_instituicoes.json")));
    }
}
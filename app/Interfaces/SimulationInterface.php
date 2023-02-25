<?php

namespace App\Interfaces;

interface SimulationInterface
{
    /**
    * Start the calculations of taxes to all instituitions and their conventions
    * @param Float $loanValue
    * @param Array|Null $convention
    * @param Array|Null $instituition
    * @param Int|Null $instalment
    * @return Array $result
   */
    public function init(float $loanValue, array $convention = null, array $instituition = null, int $instalment = null);
}
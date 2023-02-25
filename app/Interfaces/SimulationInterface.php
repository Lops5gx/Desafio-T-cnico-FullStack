<?php

namespace App\Interfaces;

interface SimulationInterface
{
    
    public function init(float $loanValue, array $convention = null, array $instituition = null, int $instalment = null);
}
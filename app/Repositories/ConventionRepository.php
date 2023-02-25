<?php 

namespace App\Repositories;

use App\Interfaces\ConventionInterface;

class ConventionRepository implements ConventionInterface
{
    public function getConventions(){
        return ['convenções'];
    }   

}
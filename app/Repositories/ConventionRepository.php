<?php 

namespace App\Repositories;

use App\Interfaces\ConventionInterface;

class ConventionRepository implements ConventionInterface
{
    public function getConventions(){
        return \File::get(storage_path("app/public/files/convenios.json"));
    }   

}
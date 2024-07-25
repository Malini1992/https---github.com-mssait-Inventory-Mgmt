<?php 

namespace App\Http\Interfaces;

interface CityService
{
     public function all();
     public function find($id); 
     public function getcities($stateId); 
}
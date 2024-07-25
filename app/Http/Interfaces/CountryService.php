<?php 

namespace App\Http\Interfaces;

interface CountryService
{
     public function all();
     public function find($id); 
}
<?php 

namespace App\Http\Interfaces;

interface StateService
{
     public function all();
     public function find($id); 
	 public function getstates($countryId); 
}
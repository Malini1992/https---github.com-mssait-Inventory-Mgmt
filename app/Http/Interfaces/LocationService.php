<?php

namespace App\Http\Interfaces;

interface LocationService
{
     public function all();
     public function create($data);
     public function find($id);
     public function update($data,$id);
     public function delete($id);


}

<?php

namespace App\Http\Repositories;

use App\Models\City;

class CityRepository
{

    public function all()
    {
        return City::all();
    }

    public function find($id)
    {
        return City::find($id);
    }

    public function getcities($stateId)
    {
        return City::where('state_id', '=', $stateId)->get();
    }

}
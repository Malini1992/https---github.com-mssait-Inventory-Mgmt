<?php

namespace App\Http\Repositories;

use App\Models\State;

class StateRepository
{

    public function all()
    {
        return State::all();
    }

    public function find($id)
    {
        return State::find($id);
    }

     public function getstates($countryId)
    {
        return State::where('country_id', '=', $countryId)->get();  
    }
}
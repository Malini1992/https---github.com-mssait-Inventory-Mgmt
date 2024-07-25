<?php

namespace App\Http\Repositories;

use App\Models\Country;

class CountryRepository
{

    public function all()
    {
        return Country::all();
    }

    public function find($id)
    {
        return Country::find($id);
    }

}
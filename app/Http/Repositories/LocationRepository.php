<?php

namespace App\Http\Repositories;

use App\Models\Location;

class LocationRepository
{
    public function all()
    {
        return Location::all();
    }

    public function create($data)
    {
        return Location::create($data);
    }

    public function find($id)
    {
        return Location::find($id);
    }

    public function save($data, $id)
    {
        $Location = Location::find($id);
        if (!$Location) {
            return null;
        }
        $Location->fill($data);
        $Location->save();
        return $Location;
    }

    public function delete($id)
    {
        return Location::where('Location_id', '=', $id)->delete();
    }
}

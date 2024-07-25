<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = 'location';
    public $timestamps = false;
    protected $primaryKey = 'location_id';

    protected $fillable = ['company_id',
    'address',
    'country',
    'state',
    'city',
    'area',
    'zipcode',
    'created_at'];

    public function country()
    {
        return $this->hasOne(Country::class,"id","country");
    }
    public function state()
    {
        return $this->hasOne(State::class,"id","state");
    }
    public function city()
    {
        return $this->hasOne(City::class,"id","city");
    }
}



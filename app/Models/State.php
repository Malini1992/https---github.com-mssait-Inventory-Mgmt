<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\OrderMaster;

class State extends Model
{
    use HasFactory;
    protected $table ="states";
    protected $primaryKey = 'id';
    public $incrementing = false; // Since your primary key is not auto-incrementing

    public function State()
    {
        return $this->hasone(City::class,"id","state_id");
    }
	public function County()
    {
        return $this->belongsto(Country::class,"country_id","id");
    }
}

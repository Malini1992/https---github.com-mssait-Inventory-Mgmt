<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table ="countries";
    protected $primaryKey = 'id';
    public $incrementing = false; // Since your primary key is not auto-incrementing

   
	public function Country()
    {
        return $this->hasone(Country::class,"id","country_id");
    }
}

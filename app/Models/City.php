<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\OrderMaster;

class City extends Model
{
    use HasFactory;
    protected $table ="cities";
   // protected $primaryKey = 'id';
    //public $incrementing = false; // Since your primary key is not auto-incrementing
    //protected $primaryKey="order_id";

    public function state()
    {
        return $this->belongsTo(state::class,"state_id","id");
    }
     public function Publisher()
    {
        return $this->hasOne(Publisher::class,"id","City");
    }
}

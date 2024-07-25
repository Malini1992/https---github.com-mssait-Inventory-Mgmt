<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Laravel\Sanctum\PersonalAccessToken; // Add this line

class Customer extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, AuthenticatableTrait;
    protected $table="customer";
    protected $schema = 'cylindermgt';
    public $timestamps = false;
    protected $primaryKey="customer_id";

    protected $fillable = [
        'customer_id',
        'customer_name',
        'contact_person',
		'mobileno',
        'alternateno',
		'gst_no',
        'mailid',
		'customer_status',
		'address_1',
		'address_2',
		'city',
		'state',
		'country',
		'zipcode',
	    'created_by',
        'created_dt',
        'modified_by',
        'modified_dt'    
    ];


}






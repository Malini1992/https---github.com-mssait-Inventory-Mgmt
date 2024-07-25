<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = 'product_type';  
    protected $schema = 'cylindermgt';
    public $timestamps = false;
    protected $primaryKey = 'product_type_id';
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
      
        'product_type',
        'product_type_status',
        'created_by',
        'created_dt',
        'modified_by',
        'modified_dt',     
    ];

}

<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = 'product';
    protected $schema = 'cylindermgt';
    public $timestamps = false;
    protected $primaryKey = 'product_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_name',
        'product_type',
        'product_qty',
		'available_qty',
        'product_status',
        'created_by',
        'created_dt',
        'modified_by',
        'modified_dt',
    ];

}

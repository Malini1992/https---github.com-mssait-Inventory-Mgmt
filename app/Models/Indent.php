<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indent extends Model
{
    use HasFactory;
    protected $table = 'indent';
    public $timestamps = false;
    protected $primaryKey = 'indent_id';


    protected $fillable = [
        'product_id',
        'customer_id',
        'issue_date',
		'issued_quantity',
        'returned_date',
        'returned_quantity',
        'reference_id',
        'status',
        'created_at',
        'updated_at',
    ];

    public function product()
    {
        return $this->hasOne(Product::class,"product_id","product_id");
    }
    public function customer()
    {
        return $this->hasOne(Customer::class,"customer_id","customer_id");
    }
}

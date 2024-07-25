<?php

namespace App\Http\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function all()
    {
        return Product::all();
    }
 
    public function create($data)
    {
        return Product::create($data);
    }

    public function find($id)
    {
        return Product::find($id);
    }

    public function save($data, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return null; 
        }
        $product->fill($data);
        $product->save();
        return $product;
    }

    public function delete($id)
    {
        return Product::where('product_id', '=', $id)->delete();
    }
}
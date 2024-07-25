<?php

namespace App\Http\Repositories;

use App\Models\ProductType;

class ProductTypeRepository
{
    public function all()
    {
        return ProductType::all();
    }
 
    public function create($data)
    {
        return ProductType::create($data);
    }

    public function find($id)
    {
        return ProductType::find($id);
    }

    public function save($data, $id)
    {
        $producttype = ProductType::find($id);
        if (!$producttype) {
            return null; 
        }
        $producttype->fill($data);
        $producttype->save();
        return $producttype;
    }

    public function delete($id)
    {
        return ProductType::where('product_type_id', '=', $id)->delete();
    }
	
	 public function destroy($id)
    {
        $producttype=ProductType::find($id);

        if (!$producttype) {
            return response()->json(['error' => 'Product Type not found'], 404);
        }

        if($producttype->product_type_status == 0){
            $new_status=1;
           // $Product=Product::find($id);
            $producttype->update(["product_type_status"=>$new_status]);

        }else{
            $new_status= 0;
           // $Product=Product::find($id);
            $producttype->update(["product_type_status"=>$new_status]);
        }
        return $producttype;

    }
}
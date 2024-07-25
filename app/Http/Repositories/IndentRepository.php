<?php

namespace App\Http\Repositories;

use App\Models\Indent;
use App\Models\Customer;
use App\Models\Product;

class IndentRepository
{
    public function all()
    {
        //return Indent::all();

        $Indent = Indent::all();
          return $Indent;
    }

    public function create($data)
    { 
        $arr = []; 
        $indentQuantities = [];
        $productQuantities = [];
    
        foreach ($data as $dta) {
            $indentId = $dta['reference_id'];
            $productId = $dta['product_id'];
            $returnQuantity = $dta['returned_quantity'];
    
            $ind = Indent::create($dta);
            array_push($arr, $ind);
    
            if (!isset($indentQuantities[$indentId])) {
                $indentQuantities[$indentId] = 0;
            }
            $indentQuantities[$indentId] += $returnQuantity;
    
            if (!isset($productQuantities[$productId])) {
                $productQuantities[$productId] = 0;
            }
            $productQuantities[$productId] += $returnQuantity;
        }
    
        foreach ($indentQuantities as $indentId => $totalReturnQuantity) {
            $indent = Indent::find($indentId);
            if ($indent) {
                $indent->returned_quantity += $totalReturnQuantity;
                $indent->save();
            }
        }  
    
        foreach ($productQuantities as $productId => $totalProductQuantity) { 
            $product = Product::find($productId);
            if ($product) {
                $product->available_qty += $totalProductQuantity;
                $product->save();
            }
        }
    
        return $arr;
    }

    public function find($id)
    {
        return Indent::find($id);
      
    }

    public function save($data, $id)
    {
        
        $arr = [];
		foreach ($data as $dta) {

			$ind = Indent::find($dta['indent_id']);
			if (!$ind) {
				return null; // or throw an exception
			}
			$ind->fill($dta);
			$ind->save();

			array_push($arr, $ind);
		}
		return $arr;


    }

    public function getreturnstatus($status)
    {
        return Indent::where('status', '=', $status)->get();  
    }

    public function getCustomerReturns($customerId,$status)
    {
        return Indent::where('customer_id', '=', $customerId)->where('status', '=', $status) ->whereColumn('returned_quantity', '<', 'issued_quantity')->get();  
    }

    public function delete($id)
    {
        return Indent::where('Indent_id', '=', $id)->delete();
    }

    public function getReturnCustomers($status)
    {
        $results = Indent::where('status', '=', $status)->get();
        // Remove duplicates based on customer_id
        $uniqueResults = $results->unique('customer_id');
    
        return $uniqueResults;

    }
   /* public function getCustomerReports()
    {
        $Indent = Customer::all();
        return $Indent;

    }*/
    
}

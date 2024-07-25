<?php

namespace App\Http\Repositories;

use App\Models\Customer;

class CustomerRepository
{
 public function all()
   {	
	$customers = Customer::all();	
	return $customers;
	}
	
public function create($data)
   {
    return Customer::create($data);
 }

 public function find($id)
    {
        return Customer::find($id);
    }

    public function save($data, $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return null; 
        }
        $customer->fill($data);
        $customer->save();
        return $customer;
    }

   /* public function delete($id)
    {
        return Customer::where('customer_id', '=', $id)->delete();
    }*/
    public function destroy($id)
    {
        $customer=Customer::find($id);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        if($customer->customer_status == 0){
            $new_status=1;
           // $Product=Product::find($id);
            $customer->update(["customer_status"=>$new_status]);

        }else{
            $new_status= 0;
           // $Product=Product::find($id);
            $customer->update(["customer_status"=>$new_status]);
        }
        return $customer;

    }
}

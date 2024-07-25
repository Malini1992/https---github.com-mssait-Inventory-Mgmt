<?php

namespace App\Http\Interfaces;

interface IndentService
{
     public function all();
     public function create($data);
     public function find($id);
     public function update($data,$id);
     public function delete($id);
    //public function getreturnstatus($status);
     public function getCustomerReturns($customerId,$status);
     public function getReturnCustomers($status);
    // public function getCustomerReports();

}

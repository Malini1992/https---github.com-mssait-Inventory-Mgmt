<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;
use App\Http\Interfaces\ProductService;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $ProductService;

    public function __construct(ProductService $ProductService)
    {
        $this->ProductService = $ProductService;
    }


    public function index()
    {
        try {
            $products = $this->ProductService->all();
            if (is_null($products)) {
                return $this->sendError('Products not found.');
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse(ProductResource::collection($products), 'Products retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     
		try {
            $validator = Validator::make($request->all(), [
                'product_name' => 'required|max:100',
                'product_type' => 'required|max:100',
                'product_qty' => 'required|max:11',
                'available_qty' => 'required|max:11',
                
               //'created_by' => 'required|max:20|regex:/^[0-9 ()-]+$/',
               //'createdBy' => 'required|max:50',
               
            ], [
                'product_name.required' => 'Product name is required.',
                'product_name.max' => 'Product name max length is 100',
                'product_type.required' => 'Product Type is required.',
                'product_type.max' => 'Product Type max length is 100',
                'product_qty.required' => 'Product Qty is required.',
                'product_qty.max' => 'Product Qty max length is 11',
			    'available_qty.required' => 'Available Qty is required.',
                'available_qty.max' => 'Available Qty max length is 11.',
                //'createdBy.required' => 'Created By is required.',
                //'createdBy.max' => 'Created By Max Length is 50.',
               
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $input = $request->all();
            $input['product_name'] = $input['product_name'];
            $input['product_type'] = $input['product_type'];
            $input['product_qty'] = $input['product_qty'];
            $input['available_qty'] = $input['available_qty'];          
            $input['created_by'] = '1';
            $input['created_dt'] = now();
            $input['product_status'] = '0';
           
            $product = $this->ProductService->create($input); //echo"<pre>";print_r($customer);exit;
			
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        try {
            $product = $this->ProductService->find($id);
            if (is_null($product)) {
                return $this->sendError('Product not found.');
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_name' => 'required|max:100',
                'product_type' => 'required|max:100',
                'product_qty' => 'required|max:11',
                'available_qty' => 'required|max:11',
            
            ], [
                'product_name.required' => 'Product name is required.',
                'product_name.max' => 'Product name max length is 100',
                'product_type.required' => 'Product Type is required.',
                'product_type.max' => 'Product Type max length is 100',
                'product_qty.required' => 'Product Qty is required.',
                'product_qty.max' => 'Product Qty max length is 11',
			    'available_qty.required' => 'Available Qty is required.',
                'available_qty.max' => 'Available Qty max length is 11.',
                //'createdBy.required' => 'Created By is required.',
                //'createdBy.max' => 'Created By Max Length is 50.',
               
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $input = $request->all();
            $input['product_name'] = $input['product_name'];
            $input['product_type'] = $input['product_type'];
            $input['product_qty'] = $input['product_qty'];
            $input['available_qty'] = $input['available_qty'];          
            $input['modified_by'] = '1';
            $input['modified_dt'] = now();
            $input['product_status'] = '0';
           
            $product = $this->ProductService->update($input, $id); //echo"<pre>";print_r($customer);exit;
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse(new ProductResource($product), 'Product updated successfully.');
    
    
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->ProductService->delete($id);

        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse([], 'Product deleted successfully');
    }
}

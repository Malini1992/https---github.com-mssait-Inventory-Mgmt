<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType;
use App\Http\Interfaces\ProductTypeService;
use App\Http\Resources\ProductTypeResource;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ProductTypeController extends Controller
{

	protected $ProductTypeService;
    public function __construct(ProductTypeService $ProductTypeService)
    {
        $this->ProductTypeService = $ProductTypeService;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    try {
            $producttype = $this->ProductTypeService->all();
            if (is_null($producttype)) {
                return $this->sendError('Product Type not found.');
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse(ProductTypeResource::collection($producttype), 'Product Type retrieved successfully.');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       try {
            $validator = Validator::make($request->all(), [

                'product_type' => 'required|max:45',
                //'created_by' => 'required|max:20|regex:/^[0-9 ()-]+$/',
               //'createdBy' => 'required|max:50',

            ], [

                'product_type.required' => 'Product Type is required.',
                'product_type.max' => 'Product Type max length is 45',
                //'createdBy.required' => 'Created By is required.',
                //'createdBy.max' => 'Created By Max Length is 50.',

            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $input = $request->all();
          //  $input['product_type'] = $input['product_type'];
            $input['created_by'] = '1';
            $input['created_dt'] = now();
            $input['product_type_status'] = '0';

            $producttype = $this->ProductTypeService->create($input);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse(new ProductTypeResource($producttype), 'Product Type created successfully.');
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
            $producttype = $this->ProductTypeService->find($id);
            if (is_null($producttype)) {
                return $this->sendError('Product type not found.');
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse(new ProductTypeResource($producttype), 'Product Type retrieved successfully.');
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

                'product_type' => 'required|max:45',
                //'created_by' => 'required|max:20|regex:/^[0-9 ()-]+$/',
               //'createdBy' => 'required|max:50',

            ], [

                'product_type.required' => 'Product Type is required.',
                'product_type.max' => 'Product Type max length is 45',
                //'createdBy.required' => 'Created By is required.',
                //'createdBy.max' => 'Created By Max Length is 50.',

            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $input = $request->all();
            $input['product_type'] = $input['product_type'];
            $input['modified_by'] = '1';
            $input['modified_dt'] = now();
            $input['product_type_status'] = '0';

            $producttype = $this->ProductTypeService->update($input, $id);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse(new ProductTypeResource($producttype), 'Product Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $producttype = $this->ProductTypeService->delete($id);

        if (is_null($producttype)) {
            return $this->sendError('Product Type not found.');
        }

        return $this->sendResponse([], 'Product Type status changed successfully');
    }
}

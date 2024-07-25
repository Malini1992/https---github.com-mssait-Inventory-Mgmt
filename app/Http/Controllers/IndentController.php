<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\IndentService;
use App\Http\Resources\IndentResource;
use App\Http\Interfaces\CustomerService;
use App\Http\Interfaces\ProductService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class IndentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $IndentService;
    protected $CustomerService;
    protected $ProductService;
    public function __construct(IndentService $IndentService, ProductService $ProductService ,CustomerService $CustomerService)
    {
        $this->IndentService = $IndentService;
        $this->ProductService= $ProductService;
        $this->CustomerService=$CustomerService;


    }

    public function index()
    {
       //$data=$request->all();
      // $Indents=$this->IndentService->all();
      // return $this->sendResponse($Indents, 'Indent retrieved successfully.');

	    try {

            //$Product=$this->ProductService->all();
           // $Customer=$this->CustomerService->all();
            $Indent = $this->IndentService->all();
            $Indent =$Indent->map(function ($IndentDetail){
                // Access the associated productMaster
              $Product = $IndentDetail->Product;
              $Customer= $IndentDetail->Customer;

              return [
                  'IndentDetail'=>$IndentDetail
              ];
              });

            if (is_null($Indent)) {
                return $this->sendError('Indent not found.');
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse($Indent, 'Indent retrieved successfully.');
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
        
            $input = $request->all();
            $Indent = $this->IndentService->create($input); //echo"<pre>";print_r($Indent);exit;

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse($Indent, 'Indent created successfully.');
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
            $Indent = $this->IndentService->find($id);
            if (is_null($Indent)) {
                return $this->sendError('Indent not found.');
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
          //return $Indent;
        return $this->sendResponse($Indent , 'Indent retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        //
        $Product=$this->ProductService->all();
        $Products = [];

     foreach ($Product as $product) {
      $Products[] = [
        'product_id' => $product->product_id,
        'product_name' => $product->product_name
      ];
      }
        $Customer=$this->CustomerService->all();
        foreach ($Customer as $customer) {
        $Customers[] = [
            'customer_id' => $customer->customer_id,
            'customer_name' => $customer->customer_name
        ];
        }
        $Indent = collect($this->IndentService->all())->where('status','=','DELD');

        // Extract IndentDetail and filter where status is DELV
        //$Indent = $indents->pluck('IndentDetail')->filter(function ($detail) {
      //      return $detail['status'] == 'DELV';
      //  });
       // $Indent = $this->IndentService->all()->where('status','=','DELD');
       // $Indent = $Indent->select(`indent_id`);
        return $this->sendResponse(compact('Products','Customers','Indent') , 'data retrieved successfully.');


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
           /* $validator = Validator::make($request->all(), [
                'first_name' => 'required|max:100',
                'last_name' => 'required|max:100',
                'mobileno' => 'required|max:100',
                'alternateno' => 'max:100',
                'mailid' => 'required|max:50|email|unique:Indent,mailid,'. $id . ',Indent_id',
               //'created_by' => 'required|max:20|regex:/^[0-9 ()-]+$/',
               //'createdBy' => 'required|max:50',

            ], [
                'first_name.required' => 'First name is required.',
                'first_name.max' => 'First name max length is 100',
                'last_name.required' => 'Last Name is required.',
                'last_name.max' => 'Last Name max length is 100',
                'mobileno.required' => 'Mobile No is required.',
                'mobileno.max' => 'Mobile No max length is 100',
				'alternateno.max' => 'Alternate No max length is 100.',
                'mailid.required' => 'Email Id is required.',
                'mailid.max' => 'Email Id max length is 50.',
                'mailid.email' => 'Valid Email is required',
                'mailid.unique' => 'Email Id already exists',
                //'createdBy.required' => 'Created By is required.',
                //'createdBy.max' => 'Created By Max Length is 50.',

            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $input = $request->all();
            $input['first_name'] = $input['first_name'];
            $input['last_name'] = $input['last_name'];
            $input['mobileno'] = $input['mobileno'];
            $input['alternateno'] = $input['alternateno'];
            $input['mailid'] = $input['mailid'];
            $input['modified_by'] = '1';
            $input['modified_dt'] = now();
            $input['Indent_status'] = '0';*/

            $Indent = $this->IndentService->update($request->all(), $id); //echo"<pre>";print_r($Indent);exit;
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse($Indent, 'Indent updated successfully.');


        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Indent = $this->IndentService->delete($id);

        if (is_null($Indent)) {
            return $this->sendError('Indent not found.');
        }

        return $this->sendResponse([], 'Indent deleted successfully');
    }
}

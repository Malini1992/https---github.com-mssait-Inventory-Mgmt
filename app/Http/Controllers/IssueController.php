<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\IndentService;
use App\Http\Resources\IndentResource;
use App\Http\Interfaces\CustomerService;
use App\Http\Interfaces\ProductService;
use Illuminate\Http\Request;
use Validator;


class IssueController extends Controller
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
            $Indent = $this->IndentService->all()->where("status","DELD");
            $Indent = $Indent->map(function ($IndentDetail) {
                // Access the associated product and customer
                //$indent=$IndentDetail->indent;
                $Product = $IndentDetail->product;
                $Customer = $IndentDetail->customer;

                 return [
                    'IndentDetail' => [
                        'indent_id' => $IndentDetail->indent_id,
                        'customer_id' => $IndentDetail->customer_id,
                        'product_id' => $IndentDetail->product_id,
                        'issue_date' => $IndentDetail->issue_date,
                        'issued_quantity' => $IndentDetail->issued_quantity,
                        //'returned_date' => $IndentDetail->returned_date,
                       // 'returned_quantity' => $IndentDetail->returned_quantity,
                        //'reference_id' => $IndentDetail->reference_id,
                        //'status' => $IndentDetail->status,
                        'product' => [
                            'product_id' => $Product->product_id,
                            'product_name' => $Product->product_name,
                            //'available_qty' => $Product->available_qty,
                        ],
                        'customer' => [
                            'customer_id' => $Customer->customer_id,
                            'customer_name' => $Customer->customer_name,
                           // 'contact_person' => $Customer->contact_person,
                           // 'mobileno' => $Customer->mobileno,
                           // 'address_1' => $Customer->address_1,
                           // 'city' => $Customer->city,
                           // 'state' => $Customer->state,
                           // 'country' => $Customer->country,
                        ]
                    ]
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
            $validator = Validator::make($request->all(), [
                'customer_id' => 'required|max:100',
                'product_id' => 'required|max:100',
                'issue_date' => 'required',
                'no_of_cylinder' => 'max:100',
                'status' => 'required|max:20',
                //'mailid' => 'required|max:50|email|unique:Indent,mailid',
               //'created_by' => 'required|max:20|regex:/^[0-9 ()-]+$/',
               //'createdBy' => 'required|max:50',

            ], [
                'customer_id.required' => 'Customer name is required.',
                'customer_id.max' => 'Customer name max length is 100',
                'product_id.required' => 'Product Type is required.',
                'product_id.max' => 'Product Type max length is 100',
                'issue_date.required' => 'Issue Date is required.',
                'no_of_cylinder.required' => 'No of Cylinder is required.',
                'no_of_cylinder.max' => 'No of Cylinder max length is 100',
                //'issue_date.max' => 'Mobile No max length is 100',
                'status.required' => 'status is required.',
                'staus.max' => 'status max length is 100',
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

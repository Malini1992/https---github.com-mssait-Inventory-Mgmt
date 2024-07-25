<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\IndentService;
use App\Http\Resources\IndentResource;
use App\Http\Interfaces\CustomerService;
use App\Http\Interfaces\ProductService;
use App\Http\Interfaces\ProductResource;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;


class ReturnController extends Controller
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

           $Return = $this->IndentService->all()->where("status","DELD"); 
            $Return = $Return->map(function ($ReturnDetail) {
                $Product = $ReturnDetail->product;
                $Customer = $ReturnDetail->customer;

                 return [
                    'ReturnDetail' => [
                        'indent_id' => $ReturnDetail->indent_id,
                        'customer_id' => $ReturnDetail->customer_id,
                        'product_id' => $ReturnDetail->product_id,
                        'issue_date' => $ReturnDetail->issue_date,
                        'issued_quantity' => $ReturnDetail->issued_quantity,
                        'returned_date' => $ReturnDetail->returned_date,
                        'returned_quantity' => $ReturnDetail->returned_quantity,
                        //'reference_id' => $IndentDetail->reference_id,
                        'status' => $ReturnDetail->status,
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
            if (is_null($Return)) {
                return $this->sendError('Indent not found.');
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse($Return, 'Indent retrieved successfully.');
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
           
            $input = $request->all(); //echo"<pre>";print_r($input);exit;
           $Indent = $this->IndentService->create($input); 
         //  $Indentqty = $this->IndentService->updateqty($input); 


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
            $Indent = $this->IndentService->find($id); //echo"<pre>";print_r($Indent);exit;
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

        public function getreturnstatus($status)
        {
            try {
    
               $Return = $this->IndentService->getreturnstatus($status); //echo"<pre>";print_r($Return);exit;
                $Return = $Return->map(function ($ReturnDetail) {
                    $Product = $ReturnDetail->product;
                    $Customer = $ReturnDetail->customer;
    
                     return [
                        'ReturnDetail' => [
                            'indent_id' => $ReturnDetail->indent_id,
                            'customer_id' => $ReturnDetail->customer_id,
                            'product_id' => $ReturnDetail->product_id,
                            'issue_date' => $ReturnDetail->issued_date,
                            'issued_quantity' => $ReturnDetail->issued_quantity,
                            'returned_date' => $ReturnDetail->returned_date,
                            'returned_quantity' => $ReturnDetail->returned_quantity,
                            //'reference_id' => $IndentDetail->reference_id,
                            'status' => $ReturnDetail->status,
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
                if (is_null($Return)) {
                    return $this->sendError('Indent not found.');
                }
            } catch (\Exception $e) {
                return $this->sendError($e->getMessage());
            }
            return $this->sendResponse($Return, 'Indent retrieved successfully.');
        }



   public function getCustomerReturns($customerId,$status)
    {
       $statusreturn = $this->IndentService->getCustomerReturns($customerId,$status); //echo"<pre>";print_r($city);exit;
       $statusreturn = $statusreturn->map(function ($statusreturnDetail) {
        $Product = $statusreturnDetail->Product;
       
        return [
            'statusreturnDetail' => [
                'indent_id' => $statusreturnDetail->indent_id,
                'customer_id' => $statusreturnDetail->customer_id,
                'product_id' => $statusreturnDetail->product_id,
                'issued_date' => $statusreturnDetail->issue_date,
                'issued_quantity' => $statusreturnDetail->issued_quantity,
                'returned_date' => $statusreturnDetail->returned_date,
                'returned_quantity' => $statusreturnDetail->returned_quantity,
                'product' => [
                    'product_id' => $Product->product_id,
                    'product_name' => $Product->product_name,
                ],
            ]
        ];
        });
       if (is_null($statusreturn)) {
                return $this->sendError('Return not found.');
        }
      return $this->sendResponse($statusreturn, 'Returns retrieved successfully.');
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


    public function getReturnCustomers($status)
    {
       $statusreturn = $this->IndentService->getReturnCustomers($status); //echo"<pre>";print_r($statusret);exit;
      //return $statusret;
      
      
       $statusreturn = $statusreturn->map(function ($statusreturnDetail) {
        $Product = $statusreturnDetail->Product;
        $Customer = $statusreturnDetail->Customer;
        return [
            'statusreturnDetail' => [
                'indent_id' => $statusreturnDetail->indent_id,
                'customer_id' => $statusreturnDetail->customer_id,
                'product_id' => $statusreturnDetail->product_id,
                'issued_date' => $statusreturnDetail->issued_date,
                'issued_quantity' => $statusreturnDetail->issued_quantity,
                'product' => [
                    'product_id' => $Product->product_id,
                    'product_name' => $Product->product_name,
                ],
                'customer' => [
                    'customer_id' => $Customer->customer_id,
                    'customer_name' => $Customer->customer_name,
                ],
            ]
        ];
        }); 
       if (is_null($statusreturn)) {
                return $this->sendError('Return not found.');
        } 
     return $this->sendResponse($statusreturn, 'Returns retrieved successfully.');
     
   
    }

   /* public function getCustomerReports()
    {
       $customerReports = $this->IndentService->getCustomerReports(); //echo"<pre>";print_r($city);exit;
     /*  $statusreturn = $statusreturn->map(function ($statusreturnDetail) {
        $Product = $statusreturnDetail->Product;
       
        return [
            'statusreturnDetail' => [
                'indent_id' => $statusreturnDetail->indent_id,
                'customer_id' => $statusreturnDetail->customer_id,
                'product_id' => $statusreturnDetail->product_id,
                'issued_date' => $statusreturnDetail->issue_date,
                'issued_quantity' => $statusreturnDetail->issued_quantity,
                'returned_date' => $statusreturnDetail->returned_date,
                'returned_quantity' => $statusreturnDetail->returned_quantity,
                'product' => [
                    'product_id' => $Product->product_id,
                    'product_name' => $Product->product_name,
                ],
            ]
        ];
        });
       if (is_null($customerReports)) {
                return $this->sendError('Reports not found.');
        }
      return $this->sendResponse($customerReports, 'Reports retrieved successfully.');
    }*/
     
}

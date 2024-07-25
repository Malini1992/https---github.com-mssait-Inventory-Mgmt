<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Interfaces\CustomerService;
use App\Http\Resources\CustomerResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $CustomerService;
    public function __construct(CustomerService $CustomerService)
    {
        $this->CustomerService = $CustomerService;

    }

    public function index()
    {
	    try {
            $customer = $this->CustomerService->all();
            if (is_null($customer)) {
                return $this->sendError('Customer not found.');
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse(CustomerResource::collection($customer), 'Customer retrieved successfully.');
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
                'customer_name' => 'required|max:100',
                'contact_person' => 'required|max:100',
			    'mobileno' => 'required|max:100',
                'alternateno' => 'max:100',
				'gst_no' => 'required|max:100',
                'mailid' => 'required|max:50|email|unique:customer,mailid',
				'address_1' => 'required|max:100',
				'address_2' => 'max:100',
				'city' => 'required|max:100',
				'state' => 'required|max:100',
				'country' => 'required|max:100',
				'zipcode' => 'required|max:10',
               //'created_by' => 'required|max:20|regex:/^[0-9 ()-]+$/',
               //'createdBy' => 'required|max:50',

            ], [
                'customer_name.required' => 'Customer name is required.',
                'customer_name.max' => 'Customer name max length is 100',
                'contact_person.required' => 'Contact Person is required.',
                'contact_person.max' => 'Contact Person max length is 100',
			    'mobileno.required' => 'Mobile No is required.',
                'mobileno.max' => 'Mobile No max length is 100',
				'alternateno.max' => 'Alternate No max length is 100.',
				'gst_no.required' => 'GST No is required.',
                'gst_no.max' => 'GST No max length is 100',
                'mailid.required' => 'Email Id is required.',
                'mailid.max' => 'Email Id max length is 50.',
                'mailid.email' => 'Valid Email is required',
                'mailid.unique' => 'Email Id already exists',
				'address_1.required' => 'Address 1 is required.',
                'address_1.max' => 'Address 1 max length is 100.',
			    'address_2.max' => 'Address 2 max length is 100.',
				'city.required' => 'City is required.',
                'city.max' => 'City max length is 100.',
				'state.required' => 'State is required.',
                'state.max' => 'State max length is 100.',
				'country.required' => 'Country is required.',
                'country.max' => 'Country max length is 100.',
				'zipcode.required' => 'Zip Code is required.',
                'zipcode.max' => 'Zip Code max length is 10.',
                //'createdBy.required' => 'Created By is required.',
                //'createdBy.max' => 'Created By Max Length is 50.',

            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $input = $request->all();
          /*  $input['customer_name'] = $input['customer_name'];
            $input['contact_person'] = $input['contact_person'];
            $input['mobileno'] = $input['mobileno'];
            $input['alternateno'] = $input['alternateno'];
			$input['gst_no'] = $input['gst_no'];
            $input['mailid'] = $input['mailid'];
			$input['address_1'] = $input['address_1'];
			$input['address_2'] = $input['address_2'];
			$input['city'] = $input['city'];
			$input['state'] = $input['state'];
			$input['country'] = $input['country'];
			$input['zipcode'] = $input['zipcode'];*/
            $input['created_by'] = '1';
            $input['created_dt'] = now();
            $input['customer_status'] = '0';

            $customer = $this->CustomerService->create($input); //echo"<pre>";print_r($customer);exit;

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse(new CustomerResource($customer), 'Customer created successfully.');
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
            $customer = $this->CustomerService->find($id);
            if (is_null($customer)) {
                return $this->sendError('Customer not found.');
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse(new CustomerResource($customer), 'Customer retrieved successfully.');
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
        try { //echo"<pre>";print_r($id);exit;
           $validator = Validator::make($request->all(), [
                'customer_name' => 'required|max:100',
                'contact_person' => 'required|max:100',
			    'mobileno' => 'required|max:100',
                'alternateno' => 'max:100',
				'gst_no' => 'required|max:100',
                'mailid' => 'required|max:50|email|unique:customer,mailid,' . $id . ',customer_id',
			    'address_1' => 'required|max:100',
				'address_2' => 'max:100',
				'city' => 'required|max:100',
				'state' => 'required|max:100',
				'country' => 'required|max:100',
				'zipcode' => 'required|max:10',
               //'created_by' => 'required|max:20|regex:/^[0-9 ()-]+$/',
               //'createdBy' => 'required|max:50',

            ], [
                'customer_name.required' => 'Customer name is required.',
                'customer_name.max' => 'Customer name max length is 100',
                'contact_person.required' => 'Contact Person is required.',
                'contact_person.max' => 'Contact Person max length is 100',
			    'mobileno.required' => 'Mobile No is required.',
                'mobileno.max' => 'Mobile No max length is 100',
				'alternateno.max' => 'Alternate No max length is 100.',
				'gst.required' => 'GST No is required.',
                'gst.max' => 'GST No max length is 100',
                'mailid.required' => 'Email Id is required.',
                'mailid.max' => 'Email Id max length is 50.',
                'mailid.email' => 'Valid Email is required',
                'mailid.unique' => 'Email Id already exists',
				'address_1.required' => 'Address 1 is required.',
                'address_1.max' => 'Address 1 max length is 100.',
			    'address_2.max' => 'Address 2 max length is 100.',
				'city.required' => 'City is required.',
                'city.max' => 'City max length is 100.',
				'state.required' => 'State is required.',
                'state.max' => 'State max length is 100.',
				'country.required' => 'Country is required.',
                'country.max' => 'Country max length is 100.',
				'zipcode.required' => 'Zip Code is required.',
                'zipcode.max' => 'Zip Code max length is 10.',
                //'createdBy.required' => 'Created By is required.',
                //'createdBy.max' => 'Created By Max Length is 50.',

            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
           $input = $request->all();
          /*  $input['customer_name'] = $input['customer_name'];
            $input['contact_person'] = $input['contact_person'];
            $input['mobileno'] = $input['mobileno'];
            $input['alternateno'] = $input['alternateno'];
			$input['gst_no'] = $input['gst_no'];
            $input['mailid'] = $input['mailid'];
			$input['address_1'] = $input['address_1'];
			$input['address_2'] = $input['address_2'];
			$input['city'] = $input['city'];
			$input['state'] = $input['state'];
			$input['country'] = $input['country'];
			$input['zipcode'] = $input['zipcode'];*/
            $input['modified_by'] = '1';
            $input['modified_dt'] = now();
            $input['customer_status'] = '0';

            $customer = $this->CustomerService->update($input, $id); //echo"<pre>";print_r($customer);exit;
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse(new CustomerResource($customer), 'Customer updated successfully.');


        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = $this->CustomerService->delete($id);

        if (is_null($customer)) {
            return $this->sendError('Customer not found.');
        }

        return $this->sendResponse([], 'Customer status changed successfully');
    }
}

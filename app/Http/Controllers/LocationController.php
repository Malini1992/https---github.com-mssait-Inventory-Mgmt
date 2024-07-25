<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\LocationResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\StateResource;
use App\Http\Resources\CityResource;
//use App\Models\Location;
//use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;
use App\Http\Interfaces\LocationService;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $LocationService;

    public function __construct(LocationService $LocationService)
    {
        $this->LocationService = $LocationService;
    }


    public function index()
    {
        try {
            $Locations = $this->LocationService->all();
            $Locations = $Locations->map(function ($locationDetail) {
            $Country = $locationDetail->Country;
            $State = $locationDetail->State;
            $City = $locationDetail->City;
            return[
                'locationdetail' => $locationDetail
            ];
            });

            if (is_null($Locations)) {
                return $this->sendError('Locations not found.');
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse($Locations, 'Locations retrieved successfully.');
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
                'company_id' => 'required|max:15',
                'address' => 'required|max:100',
                'country' => 'required|max:11',
                'state' => 'required|max:11',
                'city' => 'required|max:100',
                'area' => 'required|max:255',
                'zipcode' => 'required|max:10',


               //'created_by' => 'required|max:20|regex:/^[0-9 ()-]+$/',
               //'createdBy' => 'required|max:50',

            ], [
                'company_id.required' => 'Company id is required.',
                'company_id.max' => 'Company id max length is 15',
                'address.required' => 'Address is required.',
                'address.max' => 'Address max length is 100',
                'country.required' => 'Country is required.',
                'country.max' => 'Country max length is 11',
			    'state.required' => 'State is required.',
                'state.max' => 'State max length is 11.',
                'city.required' => 'City is required.',
                'city.max' => 'City max length is 100',
			    'area.required' => 'Area is required.',
                'area.max' => 'Area max length is 255.',
                'zipcode.required' => 'Zipcode is required.',
                'zipcode.max' => 'Zipcode max length is 10.',
                //'createdBy.required' => 'Created By is required.',
                //'createdBy.max' => 'Created By Max Length is 50.',

            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $input = $request->all();
            $input['created_by'] = '1';
            $input['created_dt'] = now();
            $input['status'] = '0';
           // return $input;

            $Location = $this->LocationService->create($input); //echo"<pre>";print_r($customer);exit;

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse(new LocationResource($Location), 'Location created successfully.');
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
            $Location = $this->LocationService->find($id);
            if (is_null($Location)) {
                return $this->sendError('Location not found.');
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse(new LocationResource($Location), 'Location retrieved successfully.');
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
                'company_id' => 'required|max:15',
                'address' => 'required|max:100',
                'country' => 'required|max:11',
                'state' => 'required|max:11',
                'city' => 'required|max:100',
                'area' => 'required|max:255',
                'zipcode' => 'required|max:10',


               //'created_by' => 'required|max:20|regex:/^[0-9 ()-]+$/',
               //'createdBy' => 'required|max:50',

            ], [
                'company_id.required' => 'Company id is required.',
                'company_id.max' => 'Company id max length is 15',
                'address.required' => 'Address is required.',
                'address.max' => 'Address max length is 100',
                'country.required' => 'Country is required.',
                'country.max' => 'Country max length is 11',
			    'state.required' => 'State is required.',
                'state.max' => 'State max length is 11.',
                'city.required' => 'City is required.',
                'city.max' => 'City max length is 100',
			    'area.required' => 'Area is required.',
                'area.max' => 'Area max length is 255.',
                'zipcode.required' => 'Zipcode is required.',
                'zipcode.max' => 'Zipcode max length is 10.',
                //'createdBy.required' => 'Created By is required.',
                //'createdBy.max' => 'Created By Max Length is 50.',

            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $input = $request->all();
            $input['modified_by'] = '1';
            $input['modified_dt'] = now();
            $input['status'] = '0';

            $Location = $this->LocationService->update($input, $id); //echo"<pre>";print_r($customer);exit;
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse(new LocationResource($Location), 'Location updated successfully.');


        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Location = $this->LocationService->delete($id);

        if (is_null($Location)) {
            return $this->sendError('Location not found.');
        }

        return $this->sendResponse([], 'Location sttatus changed successfully');
    }
}

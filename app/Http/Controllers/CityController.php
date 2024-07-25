<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;
use App\Http\Interfaces\CityService;
use Illuminate\Support\Facades\Log;


class CityController extends Controller
{
    protected $CityService;

    public function __construct(CityService $CityService)
    {
        $this->CityService = $CityService;
    }

    /**
     * Created by Malini 
     * Display the isting of the resource.
     */
    public function index()
    {
        try {
            $city = $this->CityService->all();
            if (is_null($city)) {
                return $this->sendError('City not found.');
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse(CityResource::collection($city), 'City retrieved successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $city = $this->CityService->find($id);

        if (is_null($city)) {
            return $this->sendError('City not found.');
        }

        return $this->sendResponse(new CityResource($city), 'City retrieved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function getcities($stateId)
    {
        $city = $this->CityService->getcities($stateId);

        if (is_null($city)) {
            return $this->sendError('City not found.');
        }

        return $this->sendResponse(CityResource::collection($city), 'Cities retrieved successfully.');
    }

}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;
use App\Http\Interfaces\CountryService;
use Illuminate\Support\Facades\Log;


class CountryController extends Controller
{
    protected $CountryService;

    public function __construct(CountryService $CountryService)
    {
        $this->CountryService = $CountryService;
    }

    /**
     * Created by Malini 
     * Display the isting of the resource.
     */
    public function index()
    {
        try {
            $country = $this->CountryService->all();
            if (is_null($country)) {
                return $this->sendError('Country not found.');
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse(CountryResource::collection($country), 'Country retrieved successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $country = $this->CountryService->find($id);

        if (is_null($country)) {
            return $this->sendError('Country not found.');
        }

        return $this->sendResponse(new CountryResource($country), 'Country retrieved successfully.');
    }

}

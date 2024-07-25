<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\StateResource;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;
use App\Http\Interfaces\StateService;
use Illuminate\Support\Facades\Log;


class StateController extends Controller
{
    protected $StateService;

    public function __construct(StateService $StateService)
    {
        $this->StateService = $StateService;
    }

    /**
     * Created by Malini 
     * Display the isting of the resource.
     */
    public function index()
    {
        try {
            $state = $this->StateService->all();
            if (is_null($state)) {
                return $this->sendError('State not found.');
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
        return $this->sendResponse(StateResource::collection($state), 'State retrieved successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $state = $this->StateService->find($id);

        if (is_null($state)) {
            return $this->sendError('State not found.');
        }

        return $this->sendResponse(new StateResource($state), 'State retrieved successfully.');
    }

    public function getstates($countryId)
    {
        $state = $this->StateService->getstates($countryId); //echo"<pre>";print_r($city);exit;

        if (is_null($state)) {
            return $this->sendError('State not found.');
        }

        return $this->sendResponse($state, 'State retrieved successfully.');
    }

}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            "location_id" => $this->location_id,
            "company_id" => $this->company_id,
            "address" => $this->address,
			"country" => $this->country,
            "state"=>$this->state,
			"city"=>$this->city,
            "area" => $this->area,
            "zipcode" => $this->zipcode,
            "created_dt" => $this->created_dt,
            "modified_dt" => $this->modified_dt,
        ];
    }
}

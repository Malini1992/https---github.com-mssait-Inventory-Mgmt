<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            "product_type_id" => $this->product_type_id,
            "product_type" => $this->product_type,
            "product_type_status"=>$this->product_type_status,
		    "created_by" => $this->created_by,
            "created_dt" => $this->created_dt,
            "modified_by" =>  $this->modified_by,
            "modified_dt" => $this->modified_dt,
        ];
    }
}
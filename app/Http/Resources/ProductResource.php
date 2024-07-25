<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            "product_id" => $this->product_id,
            "product_name" => $this->product_name,
			"product_type" => $this->product_type,
            "product_qty"=>$this->product_qty,
			"available_qty"=>$this->available_qty,
            "product_status" => $this->product_status,
            "created_by" => $this->created_by,
            "created_dt" => $this->created_dt,
            "modified_by" =>  $this->modified_by,
            "modified_dt" => $this->modified_dt,
        ];
    }
}
<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            "indent_id" => $this->indent_id,
            "product_id" => $this->product_id,
			"customer_id" => $this->customer_id,
            "issue_date"=>$this->issue_date,
			"issued_quantity"=>$this->issued_quantity,
            "returned_date" => $this->returned_date,
            "returned_quantity" => $this->returned_quantity,
            "reference_id" => $this->reference_id,
            "status" => $this->status,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}

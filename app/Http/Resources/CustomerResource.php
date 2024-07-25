<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {

        return [
            "customer_id"=>$this->customer_id,
            "customer_name"=>$this->customer_name,
            "contact_person"=>$this->contact_person,
            "mobileno"=>$this->mobileno,
            "alternateno"=>$this->alternateno,
			"gst_no"=>$this->gst_no,
            "mailid"=>$this->mailid,
            "customer_status"=>$this->customer_status,
			"address_1"=>$this->address_1,
			"address_2"=>$this->address_2,
			"city"=>$this->city,
			"state"=>$this->state,
			"country"=>$this->country,
			"zipcode"=>$this->zipcode,
            "created_by" =>$this->created_by,
            "created_dt" =>$this->created_dt,
            "modified_by" =>$this->modified_by,
            "modified_dt" =>$this->modified_dt,

        ];
    }
}

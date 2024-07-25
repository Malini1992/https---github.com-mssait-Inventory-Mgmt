<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {

        return [
            "id" => $this->id,
            "sortname" => $this->sortname,
            "name" => $this->name,
			"phonecode"=>$this->phonecode,     
        ];
    }
}
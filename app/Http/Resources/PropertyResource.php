<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'address' => $this->address,
            'listing_type' => $this->listing_type,
            'city' => $this->city,
            'zip_code' => $this->zip_code,
            'description' => $this->description,
            'build_year' => $this->build_year,
            'characteristic' => new CharacteristicResource($this->characteristic),
            'broker' => [
                "name" => $this->broker->name,
                "address" => $this->broker->address,
                "phone_number" => $this->broker->phone_number,
            ]
        ];
    }
}

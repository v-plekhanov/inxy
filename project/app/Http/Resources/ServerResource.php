<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'provider' => $this->provider,
            'brand' => $this->brand,
            'cpu' => $this->cpu,
            'drive' => $this->drive,
            'price' => $this->price,
        ];
    }
}

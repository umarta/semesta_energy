<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function with($request)
    {
        return [
            "success" => true,
            "message" => "{$request->route()->getName()} info retrieved successfully."
        ];
    }

    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function pagination()
    {
        return [
            'total'        => $this->resource->total(),
            'last_page'    => $this->resource->lastPage(),
            'current_page' => $this->resource->currentPage()
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Market extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource;
    }

    public function with($request)
    {
        return [
            'status' => 1,
        ];
    }
}

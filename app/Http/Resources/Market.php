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
        return [
            'id' => $this->id,
            'login' => $this->login,
            'password' => $this->password,
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'image' => $this->image
        ];
    }

    public function with($request)
    {
        return [
            'status' => 1,
        ];
    }
}

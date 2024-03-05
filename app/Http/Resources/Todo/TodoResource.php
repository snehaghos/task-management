<?php

namespace App\Http\Resources\Todo;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->description,
            'image'=>$this->image,
            'start_time'=>$this->start_time,
            'end_time'=>$this->end_time,
            'status'=>$this->status
        ];
    }
}

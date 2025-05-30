<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
           'post_id' => $this->id,
           'post_name' => $this->name,
           'post_title' => $this->title,
           'post_description' => $this->discription,
            'post_created_at' => $this->created_at,
        ];
    }
}

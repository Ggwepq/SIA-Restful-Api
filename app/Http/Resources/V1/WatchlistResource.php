<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class WatchlistResource extends JsonResource
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
            'userId' => $this->user_id,
            'title' => $this->title,
            'description' => $this->description,
            'imageUrl' => $this->image_url,
            'createdAt' => $this->created_at,
            'movies' => MovieResource::collection($this->whenLoaded('movies')),
        ];
    }
}

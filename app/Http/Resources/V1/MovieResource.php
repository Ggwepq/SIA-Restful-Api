<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class MovieResource extends JsonResource
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
            'watchlist' => new WatchlistResource($this->whenLoaded('watchlists')),
            'tmdb_id' => $this->tmdb_id,
            'added_at' => $this->added_at,
        ];
    }
}

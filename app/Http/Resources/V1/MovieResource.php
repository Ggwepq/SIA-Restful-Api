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
            'tmdbId' => $this->tmdb_id,
            'addedAt' => $this->added_at,
            'watchlist' => new WatchlistResource($this->whenLoaded('watchlist')),
        ];
    }
}

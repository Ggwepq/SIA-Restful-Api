<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreMovieRequest;
use App\Http\Resources\V1\MovieCollection;
use App\Http\Resources\V1\MovieResource;
use App\Models\Movie;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class MovieController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $movies = Movie::with('watchlist')
                ->whereHas('watchlist', function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->get();

            return $this->success(
                MovieResource::collection($movies),
                'Movies retrieved successfully.'
            );
        } catch (\Exception $e) {
            return $this->error(
                $e->getMessage(),
                "Failed to retrieve user's movies.",
                500
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {
        try {
            $validated = $request->validated();
            Movie::insert($validated);

            return $this->success(
                $validated,
                'Movies added successfully.',
                201
            );
        } catch (\Exception $e) {
            return $this->error(
                'Failed to add movies.',
                $e->getMessage(),
                500
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        try {
            if ($movie->watchlist->user_id !== Auth::id()) {
                return $this->error(
                    null,
                    'Unauthorized access to movie.',
                    403
                );
            }

            $movie->load('watchlist');

            return $this->success(
                new MovieResource($movie),
                'Movie retrieved successfully.'
            );
        } catch (\Exception $e) {
            return $this->error(
                $e->getMessage(),
                'Failed to retrieve movie.',
                500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        try {
            if ($movie->watchlist->user_id !== Auth::id()) {
                return $this->error(
                    null,
                    'Unauthorized access to delete movie.',
                    403
                );
            }

            $movie->delete();

            return $this->success(
                null,
                'Movie deleted successfully.'
            );
        } catch (\Exception $e) {
            return $this->error(
                $e->getMessage(),
                'Failed to delete movie.',
                500
            );
        }
    }
}

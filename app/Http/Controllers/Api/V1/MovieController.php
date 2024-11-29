<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreMovieRequest;
use App\Http\Resources\V1\MovieResource;
use App\Models\Movie;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the user's movies.
     */
    public function index()
    {
        try {
            // Get all movies from the user
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
     * Store a movie in storage.
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
     * Display the specific movie.
     */
    public function show(Movie $movie)
    {
        try {
            $this->checkAuthorized(
                $movie,
                'Action Unauthorized. Movie can not be accessed.',
                403
            );

            return $this->success(
                new MovieResource($movie->load('watchlist')),
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
     * Remove the specific movie from storage.
     */
    public function destroy(Movie $movie)
    {
        try {
            $this->checkAuthorized(
                $movie,
                'Action Unauthorized. You do not own this watchlist.',
                403
            );

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

    /**
     * Check if user is authorized to perform action
     */
    public function checkAuthorized(Movie $movie, string $message, int $status_code = 500)
    {
        $message = 'This action is anauthorized.';
        if ($movie->user_id !== Auth::id()) {
            return $this->error(
                null,
                $message,
                $status_code
            );
        }
    }
}

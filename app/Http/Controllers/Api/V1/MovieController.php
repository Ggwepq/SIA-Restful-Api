<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreMovieRequest;
use App\Http\Resources\V1\MovieCollection;
use App\Http\Resources\V1\MovieResource;
use App\Models\Movie;
use Illuminate\Support\Arr;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::with('watchlist')->get();
        return new MovieCollection($movies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request) {}

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return new MovieResource($movie->load('watchlist'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json(['message' => 'Movie removed successfully.']);
    }
}

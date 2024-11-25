<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreWatchlistRequest;
use App\Http\Requests\V1\UpdateMovieRequest;
use App\Http\Requests\V1\UpdateWatchlistRequest;
use App\Http\Resources\V1\WatchlistCollection;
use App\Http\Resources\V1\WatchlistResource;
use App\Models\Watchlist;

class WatchlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $watchlist = Watchlist::with('movies');
        return new WatchlistCollection($watchlist->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWatchlistRequest $request)
    {
        return new WatchlistResource(Watchlist::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Watchlist $watchlist)
    {
        return new WatchlistResource($watchlist->loadMissing('movies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWatchlistRequest $request, Watchlist $watchlist)
    {
        $watchlist->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Watchlist $watchlist)
    {
        //
    }
}

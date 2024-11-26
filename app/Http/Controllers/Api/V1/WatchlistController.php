<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreWatchlistRequest;
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
        dd($request->validated());
        $watchlist = Watchlist::create($request->validated());
        return new WatchlistResource($watchlist);
    }

    /**
     * Display the specified resource.
     */
    public function show(Watchlist $watchlist)
    {
        return new WatchlistResource($watchlist->load('movies'));
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
        $watchlist->delete();
        return response()->json(['message' => 'Watchlist deleted successfully.']);
    }
}

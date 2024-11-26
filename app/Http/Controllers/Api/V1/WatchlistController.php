<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreWatchlistRequest;
use App\Http\Requests\V1\UpdateWatchlistRequest;
use App\Http\Resources\V1\WatchlistCollection;
use App\Http\Resources\V1\WatchlistResource;
use App\Models\Watchlist;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Exception;

class WatchlistController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $watchlist = Watchlist::where('user_id', Auth::id())->with('movies')->get();

            return $this->success(
                WatchlistResource::collection($watchlist),
                'User watchlists retrieved successfully.',
                200
            );
        } catch (Exception $e) {
            return $this->error('Failed to retrieve user watchlists.', $e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWatchlistRequest $request)
    {
        try {
            $watchlist = Watchlist::create([
                'user_id' => Auth::id(),
                'title' => $request->title,
                'description' => $request->description,
                'image' => $request->image,
            ]);

            return $this->success(
                new WatchlistResource($watchlist),
                'Watchlist created successfully.',
                201
            );
        } catch (\Exception $e) {
            return $this->error('Failed to create watchlist.', $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Watchlist $watchlist)
    {
        try {
            if ($watchlist->user_id !== Auth::id()) {
                return $this->error(
                    'You are not authorized to view this watchlist.',
                    null,
                    403
                );
            }

            return $this->success(
                new WatchlistResource($watchlist),
                'Watchlist retrieved successfully.'
            );
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve watchlist.', $e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWatchlistRequest $request, Watchlist $watchlist)
    {
        if ($watchlist->user_id !== Auth::id()) {
            return $this->error(
                null,
                'This action is unauthorized. You do not own this watchlist.',
                403
            );
        }

        try {
            $watchlist->update($request->validated());

            return $this->success(
                new WatchlistResource($watchlist),
                'Watchlist updated successfully.'
            );
        } catch (\Exception $e) {
            return $this->error('Failed to update watchlist.', $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Watchlist $watchlist)
    {
        if ($watchlist->user_id !== Auth::id()) {
            return $this->error(
                null,
                'This action is unauthorized. You do not own this watchlist.',
                403
            );
        }

        try {
            $watchlist->delete();

            return $this->success(
                null,
                'Watchlist deleted successfully.'
            );
        } catch (\Exception $e) {
            return $this->error('Failed to delete watchlist.', $e->getMessage(), 500);
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'watchlist_id',
        'tmdb_id',
    ];

    public function watchlists()
    {
        return $this->belongsTo(Watchlist::class);
    }
}

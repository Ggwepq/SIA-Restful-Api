<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            '*.watchlistId' => 'required|integer',
            '*.tmdbId' => 'required|integer',
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];

        foreach ($this->toArray() as $obj) {
            // Decode the JSON string into an associative array
            $decoded = is_string($obj) ? json_decode($obj, true) : $obj;

            // Handle decoding errors
            if (!is_array($decoded)) {
                continue;  // Skip invalid entries
            }

            $obj['watchlist_id'] = $obj['watchlistId'] ?? null;
            $obj['tmdb_id'] = $obj['tmdbId'] ?? null;

            $data[] = $obj;
        }

        $this->merge($data);
    }
}

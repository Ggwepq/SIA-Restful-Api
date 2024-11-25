<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreWatchlistRequest extends FormRequest
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
            '*.userId' => 'required|integer',
            '*.title' => 'required|string',
            '*.description' => 'string',
            '*.imageUrl' => 'string',
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];

        foreach ($this->toArray() as $obj) {
            $obj['user_id'] = $obj['userId'] ?? null;
            $obj['tmdb_url'] = $obj['imageUrl'] ?? null;

            $data[] = $obj;
        }

        $this->merge($data);
    }
}

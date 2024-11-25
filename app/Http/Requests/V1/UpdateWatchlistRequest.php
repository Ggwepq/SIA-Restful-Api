<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWatchlistRequest extends FormRequest
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
        $method = $this->method();

        if ($method == 'PUT') {
            return [
                '*.title' => 'required|string',
                '*.description' => 'string',
                '*.imageUrl' => 'string',
            ];
        } else {
            return [
                '*.title' => 'sometimes|required|string',
                '*.description' => 'sometimes|string',
                '*.imageUrl' => 'sometimes|string',
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->imageUrl) {
            $this->merge([
                'image_url' => $this->imageUrl,
            ]);
        }
    }
}

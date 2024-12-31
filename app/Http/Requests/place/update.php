<?php

namespace App\Http\Requests\place;

use Illuminate\Foundation\Http\FormRequest;

class update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'        => 'nullable|string',
            'map_disc'    => 'nullable|string',
            'longitude'   => 'nullable|numeric',
            'latitude'    => 'nullable|numeric',
            'rating'      => 'nullable|numeric',
            'open_at'     => 'nullable|date_format:H:i',
            'close_at'    => 'nullable|date_format:H:i',
            'images'      => 'nullable|array',
            'images.*'    => 'nullable|image',
            'category_id' => 'nullable|exists:categories,id',
        ];
    }
}

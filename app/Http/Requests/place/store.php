<?php

namespace App\Http\Requests\place;

use Illuminate\Foundation\Http\FormRequest;

class store extends FormRequest
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
            'name'        => 'required|string',
            'map_disc'    => 'required|string',
            'longitude'   => 'required|numeric',
            'latitude'    => 'required|numeric',
            'rating'      => 'nullable|numeric',
            'open_at'     => 'required|date_format:H:i',
            'close_at'    => 'required|date_format:H:i',
            'images'      => 'required|array',
            'images.*'    => 'required|image',
            'category_id' => 'required|exists:categories,id',

        ];
    }
}

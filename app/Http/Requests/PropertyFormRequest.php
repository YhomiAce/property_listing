<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyFormRequest extends FormRequest
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
            'address' => ['required', 'max:255'],
            'listing_type' => ['required'],
            'city' => ['required'],
            'zip_code' => ['required'],
            'description' => ['required'],
            'build_year' => ['required', 'numeric'],
            'broker_id' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'bedrooms' => ['required', 'numeric'],
            'bathrooms' => ['required', 'numeric'],
            'sqft' => ['required', 'numeric'],
            'price_sqft' => ['required', 'numeric'],
            'property_type' => ['required'],
            'status' => ['required'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApartmentRequest extends FormRequest
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
            'cover_image'=>'file|max:1024|nullable|mimes:jpg,bmp,png',
        ];
    }

    public function messages():array
    {
        
        return [
            'cover_image.mimes' => "Il file deve essere un'immagine",
            'cover_image.max' => "La dimensione del file non deve superare i 1024 KB",
        ];

     }
}

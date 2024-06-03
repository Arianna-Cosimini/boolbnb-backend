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
            'name' => 'required | max:255',
            'address' => 'required | max:5000',
            'description' => 'required | max:5000',
            'room_number' => 'required | integer | between:0,10',
            'bed_number' => 'required | integer | between:0,20',
            'bathroom_number' => 'required | integer | between:0,5',
            'square_meters' => 'required | integer | between:0,500',
            'cover_image' => 'file|max:2048|nullable|mimes:jpg,bmp,png',
            'services' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (empty($value)) {
                        $fail('È necessario selezionare almeno un servizio.');
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {

        return [
            'name.required' => 'Il campo nome è obbligatorio',
            'name.max' => 'Il nome supera il numero di caratteri consentiti (:max)',
            'address.required' => "L'indirizzo è obbligatorio",
            'address.max' => "Il campo indirizzo supera il numero di caratteri consentiti (:max)",
            'description.required' => "La descrizione è obbligatoria",
            'description.max' => "Il campo descrizione supera il numero di caratteri consentiti (:max)",
            'room_number.required' => 'È necessario indicare il numero di stanze',
            'room_number.integer' => 'Il numero di stanze deve essere intero',
            'room_number.min' => 'Il numero di stanze deve essere almeno :min',
            'room_number.max' => 'Il numero di stanze non può essere superiore a :max',
            'bed_number.required' => 'È necessario indicare il numero di posti letto',
            'bed_number.integer' => 'Il numero di posti letto deve essere intero',
            'bed_number.min' => 'Il numero di posti letto deve essere almeno :min',
            'bed_number.max' => 'Il numero di posti letto non può essere superiore a :max',
            'bathroom_number.required' => 'È necessario indicare il numero di bagni',
            'bathroom_number.integer' => 'Il numero di bagni deve essere intero',
            'bathroom_number.min' => 'Il numero di bagni deve essere almeno :min',
            'bathroom_number.max' => 'Il numero di bagni non può essere superiore a :max',
            'square_meters.required' => 'È necessario indicare il numero di metri quadri',
            'square_meters.integer' => 'Il numero di metri quadri deve essere intero',
            'square_meters.min' => 'Il numero di metri quadri deve essere almeno :min',
            'square_meters.max' => 'Il numero di metri quadri non può essere superiore a :max',
            'cover_image.mimes' => "Il file deve essere un'immagine",
            'cover_image.max' => "La dimensione del file non deve superare i 2048 KB",
            'services.required' => "È necessario selezionare almeno un servizio",
        ];

    }

    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'address' => 'indirizzo',
            'description' => 'descrizione',
            'room_number' => 'numero di stanze',
            'bed_number' => 'numero di letti',
            'bathroom_number' => 'numero di bagni',
            'square_meters' => 'metri quadrati',
            'cover_image' => 'immagine di copertina',
            'services' => 'servizio',
        ];
    }
}

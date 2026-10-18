<?php

namespace App\Http\Requests;

use App\Enums\ShipmentStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreShipmentRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_name'  => ['required', 'string', 'max:255'],
            'customer_phone' => ['required', 'regex:/^[0-9+\-\s]{7,20}$/'],
            'origin'         => ['required', 'string', 'max:255'],
            'destination'    => ['required', 'string', 'max:255', 'different:origin'],
            'weight'         => ['required', 'numeric', 'min:0.1', 'max:10000'],
            'status'         => ['required', Rule::enum(ShipmentStatus::class)],
        ];
    }
}

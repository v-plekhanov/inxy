<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServerCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'provider' => 'required|string',
            'brand' => 'required|string',
            'cpu' => 'required|string',
            'location' => 'required|string',
            'drive' => 'required|string',
            'price' => 'required|integer',
        ];
    }
}

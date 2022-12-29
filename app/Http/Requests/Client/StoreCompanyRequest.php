<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'birth' => 'required|date',
            'submit_number' => 'required|integer',
            'province' => 'required|string|not_in:default',
            'city' => 'required|string|not_in:default',
            'job' => 'required|string',
            'phones' => 'array',
            'addresses' => 'array',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'birth' => 'تاریخ ثبت',
            'province' => 'استان',
            'job' => 'شغل',
            'submit_number' => 'شماره ثبت',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
        ];
    }

}

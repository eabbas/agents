<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonalRequest extends FormRequest
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
            'family' => 'required|string',
            'birth' => 'required|date',
            'father_name' => 'required|string',
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
            'birth' => 'تاریخ تولد',
            'father_name' => 'نام پدر',
            'province' => 'استان',
            'job' => 'شغل',
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
            'province.min' => 'فیلد :attribute الزامی است',
            'city.min' => 'فیلد :attribute الزامی است',
        ];
    }

}

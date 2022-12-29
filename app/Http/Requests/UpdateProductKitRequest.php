<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductKitRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'company_id' => 'string',
            'price' => 'numeric | required',
            'description' => 'required | string',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'عنوان',
            'company_id' => 'شناسه کمپانی',
            'price' => 'قیمت',
            'description' => 'توضیحات'
        ];
    }
}

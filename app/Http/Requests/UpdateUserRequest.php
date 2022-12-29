<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
    public function rules():array
    {
        return [
            'name' => 'required|string',
            'family' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'phones' => 'array',
            'addresses' => 'array',
            'password' => 'nullable',
        ];
    }

    public function attributes():array
    {
        return [
            'name' => 'نام',
            'family' => 'نام خانوادگی',
            'username' => 'نام کاربری',
            'email' => 'آدرس ایمیل',
            'phone' => 'شماره تلفن',
            'password' => 'رمز عبور',
        ];
    }
}
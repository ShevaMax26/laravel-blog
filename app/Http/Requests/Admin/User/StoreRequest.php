<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'role' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Цей поле необнідно заповнити',
            'name.string' => 'Дані повинні бути типу string',
            'email.required' => 'Цей поле необнідно заповнити',
            'email.string' => 'Дані повинні бути типу string',
            'email.unique' => 'Користувач з даним email вже існує',
            'email.email' => 'Дані повинні бути типу email@gmail.com',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_create');
    }

    public function rules()
    {
        return [
            'first_name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:users',
            ],
            'phone' => [
                'numeric',
                'digits:12',
                'nullable',
                'unique:users',
            ],
            'password' => [
                'required',
                Password::min(8)->mixedCase()->symbols()->uncompromised(),
            ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'required',
                'array',
            ],
            'company_id' => [
                'integer',
                'required',
            ],
            'last_name' => [
                'string',
                'min:3',
                'required',
            ],
        ];
    }
}

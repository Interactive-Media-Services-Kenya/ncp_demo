<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Gate;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('company_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:users',
            ],
            'phone' => [
                'string',
                'min:12',
                'nullable',
            ],
            'description' => [
                'required',
            ],
            'industry_id' => [
                'integer',
                'required',
            ],
            'city' => [
                'required',
            ],
            'address' => [
                'string',
                'min:2',
                'required',
            ],
        ];
    }
}

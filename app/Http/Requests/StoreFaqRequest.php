<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\FAQs;
use Gate;
use Illuminate\Http\Response;


class StoreFaqRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('faq_create');
    }

    public function rules()
    {
        return [
            'question' => [
                'string',
                'required',
            ],
            'answer' => [
                'required',
            ],

        ];
    }
}

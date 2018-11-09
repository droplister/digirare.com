<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'keyword' => ['sometimes', 'nullable'],
            'sort' => ['sometimes', 'nullable', 'in:asc,desc'],
            'format' => ['sometimes', 'nullable', 'in:GIF,JPG,PNG'],
            'card' => ['sometimes', 'nullable', 'exists:cards,slug'],
            'action' => ['sometimes', 'nullable', 'in:buying,selling'],
            'collection' => ['sometimes', 'nullable', 'exists:collections,slug'],
            'currency' => ['sometimes', 'nullable', 'exists:collections,currency'],
        ];
    }
}

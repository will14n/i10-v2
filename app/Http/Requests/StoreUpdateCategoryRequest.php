<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => [
                'required',
                'string',
                'min:5',
                'max:255',
                'unique:categories',
            ],
        ];

        if ($this->method() === 'PATCH' || $this->method() === 'PUT') {

            $id = $this->id ?? $this->notice;

            $rules['title'] = [
                'required',
                'string',
                'min:5',
                'max:255',
                Rule::unique('categories')->ignore($id),
            ];
        }

        return $rules;
    }
}

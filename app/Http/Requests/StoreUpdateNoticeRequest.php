<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateNoticeRequest extends FormRequest
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
                'unique:notices',
            ],
            'content' => [
                'required',
                'string',
                'min:5',
                'max:1000',
            ],
        ];

        if ($this->method() === 'PATCH' || $this->method() === 'PUT') {

            $id = $this->id ?? $this->notice;

            $rules['title'] = [
                'required',
                'string',
                'min:5',
                'max:255',
                Rule::unique('notices')->ignore($id),
            ];
            $rules['content'] = [
                'required',
                'string',
                'min:5',
                'max:1000',
            ];

        }

        return $rules;
    }
}

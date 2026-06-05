<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LookupScoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sbd' => ['required', 'string', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'sbd.required' => 'Vui lòng nhập số báo danh.',
            'sbd.max' => 'Số báo danh không quá 20 ký tự.',
        ];
    }
}

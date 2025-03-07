<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
        return [
            'sub_name' => $this->isMethod('patch') ? 'required|string|max:255' : 'required|string|max:255|unique:sub_categories,sub_name',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'sub_name.required' => 'Nama sub kategori harus diisi.',
            'sub_name.string' => 'Nama sub kategori harus berupa teks.',
            'sub_name.max' => 'Nama sub kategori maksimal 255 karakter.',
            'sub_name.unique' => 'Nama sub kategori sudah terdaftar.',
        ];
    }
}

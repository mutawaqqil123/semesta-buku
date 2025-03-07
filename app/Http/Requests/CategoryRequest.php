<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => $this->isMethod('patch') ? 'required' : 'required|string|max:255|unique:categories,name',
            'icon' => $this->isMethod('patch') ? 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048' :'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama kategori harus diisi',
            'name.unique' => 'Nama kategori sudah ada',
            'name.max' => 'Nama kategori maksimal 255 karakter',
            'icon.required' => 'Icon harus diisi',
            'icon.image' => 'Icon harus berupa gambar',
            'icon.mimes' => 'Icon harus berupa gambar dengan format jpeg, png, jpg, svg',
            'icon.max' => 'Icon maksimal 2048 KB',
        ];
    }

}

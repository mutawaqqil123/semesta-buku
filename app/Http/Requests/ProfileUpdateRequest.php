<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'phone' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'education_level' => ['required', 'string', 'max:255'],
            // 'custom_education_level' => ['required_if:education_level,other', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.string' => 'Email harus berupa teks.',
            'email.lowercase' => 'Email harus menggunakan huruf kecil.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'email.unique' => 'Email sudah digunakan.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.string' => 'Nomor telepon harus berupa teks.',
            'phone.max' => 'Nomor telepon tidak boleh lebih dari 255 karakter.',
            'status.required' => 'Status wajib diisi.',
            'status.string' => 'Status harus berupa teks.',
            'status.max' => 'Status tidak boleh lebih dari 255 karakter.',
            'education_level.required' => 'Tingkat pendidikan wajib diisi.',
            'education_level.string' => 'Tingkat pendidikan harus berupa teks.',
            'education_level.max' => 'Tingkat pendidikan tidak boleh lebih dari 255 karakter.',
            'custom_education_level.required_if' => 'Tingkat pendidikan lainnya wajib diisi jika tingkat pendidikan adalah "other".',
            'custom_education_level.string' => 'Tingkat pendidikan lainnya harus berupa teks.',
            'custom_education_level.max' => 'Tingkat pendidikan lainnya tidak boleh lebih dari 255 karakter.',
        ];
    }
}

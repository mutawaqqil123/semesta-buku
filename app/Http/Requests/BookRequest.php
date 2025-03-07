<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
        if ($this->isMethod('patch')) {
            return [
                'title' => 'required',
                'author' => 'required',
                'publisher' => 'required',
                'year' => 'required|integer|min:1900|max:' . date('Y'),
                'status' => 'required|in:available,unavailable',
                'category' => 'required',
                'description' => 'nullable',
                'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'file' => 'nullable|mimes:pdf|max:10000',
            ];
        } else {
            return [
                'title' => 'required',
                'author' => 'required',
                'publisher' => 'required',
                'year' => 'required|integer|min:1900|max:' . date('Y'),
                'status' => 'required|in:available,unavailable',
                'category' => 'required',
                'description' => 'nullable',
                'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'file' => 'required|mimes:pdf|max:10000',
            ];
        }
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul buku wajib diisi.',
            'author.required' => 'Penulis buku wajib diisi.',
            'publisher.required' => 'Penerbit buku wajib diisi.',
            'year.required' => 'Tahun terbit buku wajib diisi.',
            'year.integer' => 'Tahun terbit buku harus berupa angka.',
            'year.min' => 'Tahun terbit buku tidak boleh kurang dari 1900.',
            'year.max' => 'Tahun terbit buku tidak boleh lebih dari tahun saat ini.',
            'status.required' => 'Status buku wajib diisi.',
            'status.in' => 'Status buku harus salah satu dari: available, unavailable.',
            'category.required' => 'Kategori buku wajib diisi.',
            'cover.required' => 'Sampul buku wajib diunggah.',
            'cover.image' => 'Sampul buku harus berupa gambar.',
            'cover.mimes' => 'Sampul buku harus berformat: jpeg, png, jpg, gif, svg.',
            'cover.max' => 'Ukuran sampul buku tidak boleh lebih dari 2048 kilobyte.',
            'file.required' => 'File buku wajib diunggah.',
            'file.mimes' => 'File buku harus berformat: pdf.',
            'file.max' => 'Ukuran file buku tidak boleh lebih dari 10000 kilobyte.',
        ];
    }
}

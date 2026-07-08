<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:20',
            'portfolio_url' => 'nullable|url|max:255',
            'resume' => 'required|file|mimes:pdf|max:2048', 
        ];
    }

    public function messages(): array
    {
        return [
            'resume.mimes' => 'CV/Resume harus berupa file PDF.',
            'resume.max' => 'Ukuran CV/Resume maksimal adalah 2MB.',
        ];
    }
}

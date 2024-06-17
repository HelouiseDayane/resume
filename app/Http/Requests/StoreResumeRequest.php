<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResumeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'phone'            => 'required|string|max:20',
            'desired_position' => 'required|string|max:255',
            'education'        => 'required|string|max:255',
            'observations'     => 'nullable|string',
            'resume_file'      => 'required|mimes:pdf,doc,docx|max:2048',
            'ip'               => 'required|ip',
        ];
    }
}

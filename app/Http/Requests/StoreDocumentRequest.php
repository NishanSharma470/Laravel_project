<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string', 
            'file' => 'required|file|mimes:pdf,docx,jpeg,jpg,png|max:2048'
            
        ];
    }

    public function message(){
        return[
            'title' => 'this field is required for the submitted the form or document',
            'description '=> 'You need the describe the provide the summary of document',
           
        ];
    }
}

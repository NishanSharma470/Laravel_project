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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        'usertype' => ['required', 'in:internal,external'],
        ];
        if ($this->input('usertype') === 'internal') {
            $rules['department'] = ['required', 'string', 'max:255'];
        } elseif ($this->input('usertype') === 'external') {
            $rules['company'] = ['required', 'string', 'max:255'];
        }

        return $rules;
    }
}

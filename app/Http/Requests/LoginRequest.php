<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string email
 * @property string password
 * @property boolean remember
 */

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:6', 'max:24'],
            'remember' => ['nullable', 'boolean'],
        ];
    }
}

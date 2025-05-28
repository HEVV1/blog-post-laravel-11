<?php

namespace App\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property string $email
 * @property string $password
 */
class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'bail',
                'required',
                'string',
                'min:4',
                'max:255',
            ],
            'email' => [
                'bail',
                'required',
                'string',
                'email',
                'max:255',
                'unique:table_user,email',
            ],
            'password' => [
                'bail',
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->uncompromised(),
            ],
        ];
    }
}
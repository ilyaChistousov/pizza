<?php

namespace App\Http\Requests\Auth;

use App\DTO\User\NewUserDTO;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
            'phone' => ['required', 'string', 'max:255', 'unique:'.User::class],
        ];
    }

    public function dto(): NewUserDTO {
        $data = $this->validated();
        $data['password'] = Hash::make($data['password']);
        return NewUserDTO::from($data);
    }
}

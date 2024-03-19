<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class UserUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string', 'min:3', 'max:150'],
            'email' => ['string', 'email', 'max:255', $this->uniqueEmail()],
        ];
    }

    protected function uniqueEmail(): Unique
    {
        return Rule::unique(User::class, 'email',)->ignore($this->user()->id);
    }
}

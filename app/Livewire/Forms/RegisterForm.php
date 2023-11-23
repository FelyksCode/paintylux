<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RegisterForm extends Form
{
    #[Validate]
    public string $name = '';

    #[Validate]
    public string $email = '';

    #[Validate]
    public string $password = '';

    #[Validate]
    public string $password_confirmation = '';

    // Custom error messages
    protected $messages = [
        'name.required' => 'Mohon mengisi nama Anda.',
        'name.max' => 'Nama yang diisi terlalu panjang.',
        'email.required' => 'Mohon mengisi email Anda.',
        'email.lowercase' => 'Email tidak boleh ada huruf kapital.',
        'email.email' => 'Mohon mengisi email yang valid.',
        'email.max' => 'Email yang diisi terlalu panjang.',
        'email.unique' => 'Email sudah terpakai.',
        'password' => 'Password Anda harus minimal 8 karakter.',
        'password.required' => 'Mohon mengisi password Anda.',
        'password_confirmation.same' => 'Password yang diisi belum sama.',
    ];

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', Rules\Password::defaults()],
            'password_confirmation' => 'same:password',
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }
}

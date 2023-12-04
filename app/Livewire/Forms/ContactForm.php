<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ContactForm extends Form
{
    #[Validate]
    public string $sender = '';

    #[Validate]
    public string $contact = '';

    #[Validate]
    public string $location = '';

    #[Validate]
    public string $content = '';

    // Custom error messages
    protected $messages = [
        'sender.required' => 'Mohon mengisi nama Anda.',
        'sender.max' => 'Nama yang diisi terlalu panjang.',
        'contact.required' => 'Mohon mengisi email atau nomor telepon Anda.',
        'contact.regex' => 'Mohon mengisi email atau nomor telepon yang valid.',
        'location.required' => 'Mohon mengisi lokasi Anda.',
        'location.max' => 'Lokasi yang diisi terlalu panjang.',
        'content.required' => 'Mohon mengisi pesan Anda.',
        'content.max' => 'Pesan yang diisi terlalu panjang.',
    ];

    public function boot()
    {
        $this->sender = Auth::check() ? Auth::user()->name : $this->sender;
        $this->contact = Auth::check() ? Auth::user()->email : $this->contact;
    }

    public function rules()
    {
        // Form contact regexp
        $email_regexp = trim(config("const.REGEXP.email"), '/');
        $phone_regexp = trim(config("const.REGEXP.phone"), '/');
        $contact_regexp = "/($email_regexp)|($phone_regexp)/";

        // Retun rules
        return [
            'sender' => ['required', 'string', 'max:50'],
            'contact' => ['required', 'string', "regex:$contact_regexp", 'max:255'],
            'location' => ['required', 'string', 'max:50'],
            'content' => ['required', 'string', 'max:1000'],
        ];
    }
}

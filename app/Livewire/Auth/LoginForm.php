<?php

namespace App\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginForm extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => ['required', 'string', 'email'],
        'password' => ['required', 'string'],
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();
            $this->redirect(RouteServiceProvider::HOME);
        }

        $this->addError('email', trans('auth.failed'));
        $this->reset('password');
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }
}

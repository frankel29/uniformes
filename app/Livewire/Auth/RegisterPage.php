<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


#[Title('Registro')]
class RegisterPage extends Component
{

    public $name;
    public $email;
    public $password;

    //resgiter user
    public function save(){
        $this->validate([
            'name'=> 'required|max:255',
            'email'=> 'required|email|unique:users|max:255',
            'password'=> 'required|min:6|max:255',
        ]);

        //save to database
        $user = User::create([
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>Hash::make($this->password),
        ]);

        //login
        auth()->login($user);

        //redireccionar al home

        return redirect()->intended();
    }

    public function render()
    {
        return view('livewire.auth.register-page');
    }
}

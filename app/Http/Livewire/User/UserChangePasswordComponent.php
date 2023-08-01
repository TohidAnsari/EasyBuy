<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserChangePasswordComponent extends Component
{

    public $current_password;
    public $new_password;
    public $confirm_password;

    public function update($fields){
        $this->validateOnly($fields, [
            'current_password'  => 'required',
            'new_password'      => 'required | min:8 |different:current_password|confirmed',
            'confirm_password'  => 'required'
        ]);
    }

    public function changePassword(){
        $this->validate([
            'current_password'  => 'required',
            'new_password'      => 'required | min:8 |different:current_password',
            'confirm_password'  => 'required |same:new_password'
        ]);
        if(Hash::check($this->current_password, Auth::user()->password)){
            $user = User::findOrFail(Auth::user()->id);
            $user->password = Hash::make($this->new_password);
            $user->save();
            session()->flash('password_changed_success', 'Password Changed Successfuly..!');
        }
        else{
            session()->flash('password_changed_error', 'Password does not match..!');
        }
    }

    public function render()
    {
        return view('livewire.user.user-change-password-component')->layout('layouts.base');
    }
}

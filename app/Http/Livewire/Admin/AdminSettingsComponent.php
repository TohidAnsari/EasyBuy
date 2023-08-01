<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Settings;

class AdminSettingsComponent extends Component
{

    public $email;
    public $phone1;
    public $phone2;
    public $address1;
    public $map;
    public $twiter;
    public $facebook;
    public $instagram;
    public $pinterest;
    public $youtube;

    public function mount()
    {
        $setting = Settings::find(1);
        $this->email        =   $setting->email;
        $this->phone1       =   $setting->phone1;
        $this->phone2       =   $setting->phone2;
        $this->address1     =   $setting->address1;
        $this->map          =   $setting->map;
        $this->twiter       =   $setting->twiter;
        $this->facebook     =   $setting->facebook;
        $this->instagram    =   $setting->instagram;
        $this->pinterest    =   $setting->pinterest;
        $this->youtube      =   $setting->youtube;
    }
    public function update($fields)
    {
        $this->validateOnly($fields, [
            'email'         =>  'required|email',
            'phone1'        =>  'required',
            'phone2'        =>  'required',
            'address1'      =>  'required',
            'map'           =>  'required',
            'twiter'        =>  'required',
            'facebook'      =>  'required',
            'instagram'     =>  'required',
            'pinterest'     =>  'required',
            'youtube'       =>  'required'
        ]);
    }

    function saveSettings()
    {
        $this->validate([
            'email'         =>  'required|email',
            'phone1'        =>  'required',
            'phone2'        =>  'required',
            'address1'      =>  'required',
            'map'           =>  'required',
            'twiter'        =>  'required',
            'facebook'      =>  'required',
            'instagram'     =>  'required',
            'pinterest'     =>  'required',
            'youtube'       =>  'required'
        ]);

        $setting = Settings::find(1);
        if (!$setting) {
            $setting = new Settings();
        }
        $setting->email        =     $this->email;
        $setting->phone1       =     $this->phone1;
        $setting->phone2       =     $this->phone2;
        $setting->address1     =     $this->address1;
        $setting->map          =     $this->map;
        $setting->twiter       =     $this->twiter;
        $setting->facebook     =     $this->facebook;
        $setting->instagram    =     $this->instagram;
        $setting->pinterest    =     $this->pinterest;
        $setting->youtube      =     $this->youtube;
        $setting->save();
        session()->flash('settings_saved', 'Settings Saved Successfuly..!');
    }


    public function render()
    {
        return view('livewire.admin.admin-settings-component')->layout('layouts.base');
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;
use App\Models\Settings;

class ContactComponent extends Component
{
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $comment;


    public function contact(){

        $contact = new Contact();
        $contact->name      = $this->name;
        $contact->email     = $this->email;
        $contact->phone     = $this->phone;
        $contact->comment   = $this->comment;
        $contact->save();
        session()->flash('contact_sent', 'Message sent. Thanks for suggestion, We will contact you soon.');
    }

    public function render()
    {
        $settings = Settings::find(1);
        return view('livewire.contact-component', ['settings' => $settings])->layout('layouts.base');
    }
}

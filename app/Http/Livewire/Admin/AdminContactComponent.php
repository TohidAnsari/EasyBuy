<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Contact;

class AdminContactComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $contacts = Contact::orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.admin.admin-contact-component', ['contacts' => $contacts])->layout('layouts.base');
    }
}

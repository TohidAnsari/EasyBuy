<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddToCart extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function render()
    {
        return view('livewire.add-to-cart');
    }
}

<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomePageSlider;
use Livewire\Component;
use Livewire\WithPagination;

class AdminHomeSlider extends Component
{
   
    use WithPagination;
    function deleteSlider($id){
        $slider = HomePageSlider::find($id);
        if(!empty($slider)){
            $image = $slider->image;
            unlink('storage/products/sliders/'.$image);    
            $slider->delete();
            session()->flash('sliderDeleted', 'Slider Deleted Successfully');
        }

    }
    public function render()
    {
        $sliders = HomePageSlider::paginate(5);
        return view('livewire.admin.admin-home-slider', ['sliders' => $sliders])->layout('layouts.base');
    }
}

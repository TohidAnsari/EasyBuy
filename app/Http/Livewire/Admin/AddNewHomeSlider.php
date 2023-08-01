<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomePageSlider;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Livewire\Component;

class AddNewHomeSlider extends Component
{
    use WithFileUploads;

    public $title;
    public $subtitle;
    public $price;
    public $link;
    public $status;
    public $image;

    function mount()
    {
        $this->status = 1;
    }

    function update($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required',
            'subtitle' => 'required',
            'price' => 'required',
            'link' => 'required',
            'status' => 'required',
            'image' => 'required'
        ]);
    }
    function addSlider()
    {
        $this->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'price' => 'required',
            'link' => 'required',
            'status' => 'required',
            'image' => 'required'
        ]);

        $slider = new HomePageSlider();
        $slider->title      =   $this->title;
        $slider->subtitle   =   $this->subtitle;
        $slider->price      =   $this->price;
        $slider->link       =   $this->link;
        $slider->status     =   $this->status;

        $photo = $this->image;
        $image_name = "Slider_".now()->timestamp . "." . $photo->extension();
        $img = Image::make($photo);
        $img->resize(1000, 430);
        $img->save('storage/products/sliders/' . $image_name);
        $slider->image      =  $image_name;
        // \dd($slider, $image_name);
        $slider->save();
        session()->flash('sliderAdded', 'Slide Added Successfully..!');
    }

    public function render()
    {
        return view('livewire.admin.add-new-home-slider')->layout('layouts.base');
    }
}

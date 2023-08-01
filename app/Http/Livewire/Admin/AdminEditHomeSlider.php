<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomePageSlider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class AdminEditHomeSlider extends Component
{
    use WithFileUploads;

    public $title;
    public $subtitle;
    public $price;
    public $link;
    public $status;
    public $image;
    public $newImage;
    public $slider_id;

    function mount($slider_id)
    {
        $slider           = HomePageSlider::find($slider_id);
        $this->title      =    $slider->title;
        $this->subtitle   =    $slider->subtitle;
        $this->price      =    $slider->price;
        $this->link       =    $slider->link;
        $this->status     =    $slider->status;
        $this->image      =    $slider->image;
        $this->slider_id  =    $slider->id;
    }
    function update($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required | unique:title',
            'subtitle' => 'required | unique:subtitle',
            'price' => 'required',
            'link' => 'required',
            'status' => 'required',
        ]);
    }
    function editSlider()
    {
        $this->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'price' => 'required',
            'link' => 'required',
            'status' => 'required',
        ]);
        $slider             =   HomePageSlider::find($this->slider_id);
        $slider->title      =   $this->title;
        $slider->subtitle   =   $this->subtitle;
        $slider->price      =   $this->price;
        $slider->link       =   $this->link;
        $slider->status     =   $this->status;
        if($this->newImage){
            unlink('storage/products/sliders/'.$this->image);
            // dd($this->image);
            $photo = $this->newImage;
            $image_name = now()->timestamp . "." . $photo->extension();
            $img = Image::make($photo);
            $img->resize(1000, 430);
            $img->save('storage/products/sliders/' . $image_name);
            $slider->image      =  $image_name;
        }
        $slider->save();
        session()->flash('sliderUpdated', 'Slide Updated Successfully..!');
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-home-slider')->layout('layouts.base');
    }
}

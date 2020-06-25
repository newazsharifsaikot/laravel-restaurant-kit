<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Slider;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::latest()->get();
        return view('admin.slider.index')->with(compact('sliders'));
    }
    public function create(){
        return view('admin.slider.create');
    }

    public function store(Request $request){
       $this->validate($request,[
          'title' => 'bail|required|string|unique:sliders',
          'sub_title' => 'required|string',
          'image' => 'bail|required|image|mimes:jpg,jpeg,png,bnp,gif',
       ]);

       $image = $request->file('image');
       $slug = Str::slug($request->title);

       if (isset($image)){
           $currentDate = Carbon::now()->toDateString();
           $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

           if (!Storage::disk('public')->exists('slider')){
               Storage::disk('public')->makeDirectory('slider');
           }
           $slider_image =  Image::make($image)->resize(1600, 512)->stream();
           Storage::disk('public')->put('slider/'.$imageName,$slider_image);
       }else{
           $imageName = 'default.png';
       }

       $slider = new Slider();
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $imageName;
        if (isset($request->status)){
            $slider->status = true;
        }else{
            $slider->status = false;
        }
        $slider->save();
        Toastr::success('Slider Created Successfully' ,'Success');
        return redirect()->route('admin.slider');

    }

    public function edit($id){
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit')->with(compact('slider'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'title' => 'bail|required|string|unique:sliders,title,'.$id,
            'sub_title' => 'required|string',
            'image' => 'bail|image|mimes:jpg,jpeg,png,bnp,gif',
        ]);
        $slider = Slider::findOrFail($id);
        $image = $request->file('image');
        $slug = Str::slug($request->title);

        if (isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('slider')){
                Storage::disk('public')->makeDirectory('slider');
            }
            if (Storage::disk('public')->exists('slider/'.$slider->image)){
                Storage::disk('public')->delete('slider/'.$slider->image);
            }
            $slider_image =  Image::make($image)->resize(1600, 512)->stream();
            Storage::disk('public')->put('slider/'.$imageName,$slider_image);
        }else{
            $imageName = $slider->image;
        }

        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $imageName;
        if (isset($request->status)){
            $slider->status = true;
        }else{
            $slider->status = false;
        }
        $slider->save();
        Toastr::success('Slider Updated Successfully' ,'Success');
        return redirect()->route('admin.slider');
    }

    public function destroy($id){
        $slider = Slider::findOrFail($id);
        if (Storage::disk('public')->exists('slider/'.$slider->image)){
            Storage::disk('public')->delete('slider/'.$slider->image);
        }
        $slider->delete();
        Toastr::success('Slider Deleted Successfully' ,'Success');
        return redirect()->back();
    }

    public function publish($id){
        $slider = Slider::findOrFail($id);
        if ($slider->status == false){
            $slider->status = true;
            $slider->save();
            Toastr::success('Slider Published Successfully' ,'Success');
            return redirect()->back();
        }
    }

    public function pending($id){
        $slider = Slider::findOrFail($id);
        if ($slider->status == true){
            $slider->status = false;
            $slider->save();
            Toastr::success('Slider Un-Published Successfully' ,'Success');
            return redirect()->back();
        }
    }


}

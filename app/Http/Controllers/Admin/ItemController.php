<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Item;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class ItemController extends Controller
{
    public function index(){
        $items = Item::latest()->get();
        return view('admin.item.index')->with(compact('items'));
    }
    public function create(){
        $categories = Category::where('status', true)->get();
        return view('admin.item.create')->with(compact('categories'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'category' => 'required',
            'name' => 'bail|required|string|unique:items',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'bail|required|image|mimes:jpg,jpeg,png,bnp,gif',
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if (isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('item')){
                Storage::disk('public')->makeDirectory('item');
            }
            $item_image =  Image::make($image)->resize(500, 385)->stream();
            Storage::disk('public')->put('item/'.$imageName,$item_image);
        }else{
            $imageName = 'default.png';
        }

        $item = new Item();
        $item->category_id = $request->category;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->image = $imageName;
        if (isset($request->status)){
            $item->status = true;
        }else{
            $item->status = false;
        }
        $item->save();
        Toastr::success('Item Created Successfully' ,'Success');
        return redirect()->route('admin.item');

    }

    public function edit($id){
        $item = Item::findOrFail($id);
        $categories = Category::where('status', true)->get();
        return view('admin.item.edit')->with(compact('item','categories'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'category' => 'required',
            'name' => 'bail|required|string|unique:items,name,'.$id,
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'bail|image|mimes:jpg,jpeg,png,bnp,gif',
        ]);
        $item = Item::findOrFail($id);
        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if (isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('item')){
                Storage::disk('public')->makeDirectory('item');
            }
            if (Storage::disk('public')->exists('item/'.$item->image)){
                Storage::disk('public')->delete('item/'.$item->image);
            }
            $item_image =  Image::make($image)->resize(500, 385)->stream();
            Storage::disk('public')->put('item/'.$imageName,$item_image);
        }else{
            $imageName = $item->image;
        }

        $item->category_id = $request->category;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->image = $imageName;
        if (isset($request->status)){
            $item->status = true;
        }else{
            $item->status = false;
        }
        $item->save();
        Toastr::success('Item Updated Successfully' ,'Success');
        return redirect()->route('admin.item');
    }

    public function destroy($id){
        $item = Item::findOrFail($id);
        if (Storage::disk('public')->exists('item/'.$item->image)){
            Storage::disk('public')->delete('item/'.$item->image);
        }
        $item->delete();
        Toastr::success('Item Deleted Successfully' ,'Success');
        return redirect()->back();
    }

    public function publish($id){
        $item = Item::findOrFail($id);
        if ($item->status == false){
            $item->status = true;
            $item->save();
            Toastr::success('Item Published Successfully' ,'Success');
            return redirect()->back();
        }
    }

    public function pending($id){
        $item = Item::findOrFail($id);
        if ($item->status == true){
            $item->status = false;
            $item->save();
            Toastr::success('Item Un-Published Successfully' ,'Success');
            return redirect()->back();
        }
    }
}

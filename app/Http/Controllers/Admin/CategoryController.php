<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->get();
        return view('admin.category.index')->with(compact('categories'));
    }
    public function create(){
        return view('admin.category.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'bail|required|string|unique:categories',
        ]);
        $category = new Category();
        $category->name = ucfirst($request->name);
        $category->slug = Str::slug($request->name);
        if (isset($request->status)){
            $category->status = true;
        }else{
            $category->status = false;
        }
        $category->save();
        Toastr::success('Category Created Successfully' ,'Success');
        return redirect()->route('admin.category');

    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.category.edit')->with(compact('category'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'name' => 'bail|required|string|unique:categories,name,'.$id,
        ]);
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        if (isset($request->status)){
            $category->status = true;
        }else{
            $category->status = false;
        }
        $category->save();
        Toastr::success('Category Updated Successfully' ,'Success');
        return redirect()->route('admin.category');
    }

    public function destroy($id){
        $category = Category::findOrFail($id);
        $category->delete();
        Toastr::success('Category Deleted Successfully' ,'Success');
        return redirect()->back();
    }

    public function publish($id){
        $category = Category::findOrFail($id);
        if ($category->status == false){
            $category->status = true;
            $category->save();
            Toastr::success('Category Published Successfully' ,'Success');
            return redirect()->back();
        }
    }

    public function pending($id){
        $category = Category::findOrFail($id);
        if ($category->status == true){
            $category->status = false;
            $category->save();
            Toastr::success('Category Un-Published Successfully' ,'Success');
            return redirect()->back();
        }
    }
}

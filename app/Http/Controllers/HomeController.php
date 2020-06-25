<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliders = Slider::where('status', true)->get();
        $categories = Category::where('status',true)->get();
        $items = Item::where('status', true)->get();
        return view('welcome')->with(compact('sliders','categories','items'));
    }

}

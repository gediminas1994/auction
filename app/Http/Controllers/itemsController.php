<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class itemsController extends Controller
{
    public function create(){
    	return view('items.create');
    } 

    public function show(Item $item){
    	return view('items.show')->with('item', $item);
    }
}

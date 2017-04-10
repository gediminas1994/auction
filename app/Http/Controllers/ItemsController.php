<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use function PHPSTORM_META\type;

class ItemsController extends Controller
{
    public function create(){
        $categories = Category::where('parent', 0)->get();
        $subcategories = Category::where('parent', '!=', 0)->get();
    	return view('items.create')
            ->with('categories', $categories)
            ->with('subcategories', $subcategories);
    }

    public function show(Item $item){
    	return view('items.show')->with('item', $item);
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'expirationDate' => 'required_if:type,0',
            'quantity' => 'required_if:type,1',
            'startingBid' => 'required_if:type,0',
            'picture' => 'required|image'
        ]);

        $user_id = Auth::user()->id;
        $title = Input::get('title');
        $type = Input::get('type');
        $description = Input::get('description');
        $expirationDate = Input::get('expirationDate');
        $quantity = Input::get('quantity');
        $startingBid = Input::get('startingBid');
        if(Input::hasFile('picture')){
            $picture = Input::file('picture');
            $picture->move('items/', $picture->getClientOriginalName());
            $picturePath = $picture->getClientOriginalName();
        }


        Item::createItem($user_id, $title, $type, $description, $expirationDate, $quantity, $startingBid, $picturePath);

        return back()->withInput();
    }
}

<?php

namespace App\Http\Controllers\user;

use App\Category;
use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::where('user_id', Auth::user()->id)->get();
        return view('user.items.index')->with('items', $items);
    }


    public function create()
    {
        $categories = Category::where('parent', 0)->get();
        $subcategories = Category::where('parent', '!=', 0)->get();
        return view('user.items.create')
            ->with('categories', $categories)
            ->with('subcategories', $subcategories);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'expirationDate' => 'required_if:type,0',
            'quantity' => 'required_if:type,1',
            'startingBid' => 'required_if:type,0',
            'picture' => 'required'
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
            $picturePath = '/items/' . $picture->getClientOriginalName();
        }

        $item = new Item();
        $item->createItem($user_id, $title, $type, $description, $expirationDate, $quantity, $startingBid, $picturePath);

        return back()->withInput();
    }


    public function show($user_id, $item_id)
    {
        $item = Item::where('id', $item_id)->first();
        return view('user.items.show')->with('item', $item);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}

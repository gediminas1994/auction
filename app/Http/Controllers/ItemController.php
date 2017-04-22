<?php

namespace App\Http\Controllers;

use App\Category;
use App\Favorite;
use App\Product;
use App\Mailing_Service;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\In;

class ItemController extends Controller
{
    public function index()
    {
        $items = Product::all();
        return view('items.index')->with('items', $items);
    }


    public function create()
    {
        $categories = Category::where('parent_id', null)->get();
        $subcategories = Category::where('parent_id', '!=', null)->get();
        $mailing_services = Mailing_Service::all();
        return view('items.create')
            ->with('categories', $categories)
            ->with('subcategories', $subcategories)
            ->with('mailing_services', $mailing_services);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'categories' => 'required',
            'mailing_services' => 'required',
            'picture' => 'required',
            'expirationDate' => 'required_if:type,0',
            'startingBid' => 'required_if:type,0',
            'quantity' => 'required_if:type,1'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $user_id = Auth::user()->id;
        $title = Input::get('title');
        $type = Input::get('type');
        $description = Input::get('description');
        $expirationDate = Input::get('expirationDate');
        $quantity = Input::get('quantity');
        $startingBid = Input::get('startingBid');
        $mailingServiceId = Input::get('mailing_services');
        if(Input::hasFile('picture')){
            $picture = Input::file('picture');
            $picture->move('items/', $picture->getClientOriginalName());
            $picturePath = '/items/' . $picture->getClientOriginalName();
        }

        $submittedCategories = Input::get('categories');

        $item = new Product();
        $item->createItem($user_id, $title, $type, $description, $expirationDate, $quantity, $startingBid, $mailingServiceId, $picturePath, $submittedCategories);

        Session::flash('message','Product was created succesfully!');

        return redirect()->route('user.listedItems', Auth::user());
    }


    public function show($id)
    {
        $item = Product::where('id', $id)->first();
        return view('items.show')->with('item', $item);
    }


    public function edit($id)
    {
        $item = Product::find($id);
        return view('items.edit')
            ->with('item', $item);
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        $item = Product::find($id);
        $item->delete();

        Session::flash('message','Product was deleted');
    }


    public function listedItems(){
        $user_id = Auth::user()->id;
        $items = Product::where('user_id', $user_id)->get();
        return view('user.items.listedItems')->with('items', $items);
    }


    public function addToFavorites($id){
        $user = Auth::user();
        $product_id = $id;
        $user->favorites()->attach($product_id);
        return response();
    }


    public function showFavorites(){
        $favorites = Auth::user()->favorites;

        return view('user.items.favorites')->with('favorites', $favorites);
    }

    public function showItemsByType($type){
        if($type == 'auctions'){
            $items = Product::where('type', 0)
                ->orderBy('created_at', 'desc')
                ->paginate(9);
        }else{
            $items = Product::where('type', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(9);
        }

        return view('items.index')->with('items', $items);
    }
}

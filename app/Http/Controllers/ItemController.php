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
        $categories = Category::where('parent', 0)->get();
        $subcategories = Category::where('parent', '!=', 0)->get();
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
            'mailing_services' => 'required',
            'expirationDate' => 'required_if:type,0',
            'quantity' => 'required_if:type,1',
            'startingBid' => 'required_if:type,0',
            'mailing_services' => 'required',
            'picture' => 'required',
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

        $item = new Product();
        $item->createItem($user_id, $title, $type, $description, $expirationDate, $quantity, $startingBid, $mailingServiceId, $picturePath);

        $submittedTags = Input::get('tags');
        $lastItemStoredByUser = Product::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->first();

        foreach ($submittedTags as $submittedTag){
            $category_id = $submittedTag;
            $item_id = $lastItemStoredByUser->id;

            $tags = new Tag();
            $tags->category_id = $category_id;
            $tags->item_id = $item_id;
            $tags->save();
        }

        Session::flash('message','Product was created succesfully!');

        return redirect()->route('user.listedItems', Auth::user());
    }


    public function show($item)
    {
        $item = Product::where('id', $item)->first();
        return view('items.show')->with('item', $item);
    }


    public function edit($item_id)
    {
        $item = Product::where('id', $item_id)->where('user_id', Auth::user())->first();
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

        return redirect()->route('user.listedItems', Auth::user());
    }



    public function listedItems(){
        $user_id = Auth::user()->id;
        $items = Product::where('user_id', $user_id)->get();
        return view('user.items.listedItems')->with('items', $items);
    }

    public function addToFavorites($id){
        if(Favorite::where('user_id', Auth::user()->id)->where('item_id', $id)->first()){
            //do nothing couse the item is already marked
        }else{
            $favorites = new Favorite();
            $favorites->user_id = Auth::user()->id;
            $favorites->item_id = $id;
            $favorites->save();
        }
    }

    public function favorites(){
        $user_id = Auth::user()->id;

        $favorite_ids = Favorite::where('user_id', $user_id)->get();

        return view('user.items.favorites')->with('favorites', $favorite_ids);
    }
}

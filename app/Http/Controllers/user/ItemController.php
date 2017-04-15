<?php

namespace App\Http\Controllers\user;

use App\Category;
use App\Item;
use App\Mailing_Service;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
        $mailing_services = Mailing_Service::all();
        return view('user.items.create')
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
            'picture' => 'required'
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
        if(Input::hasFile('picture')){
            $picture = Input::file('picture');
            $picture->move('items/', $picture->getClientOriginalName());
            $picturePath = '/items/' . $picture->getClientOriginalName();
        }

        $item = new Item();
        $item->createItem($user_id, $title, $type, $description, $expirationDate, $quantity, $startingBid, $picturePath);

        $submittedTags = Input::get('tags');
        $lastItemStoredByUser = Item::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->first();

        foreach ($submittedTags as $submittedTag){
            $category_id = $submittedTag;
            $item_id = $lastItemStoredByUser->id;

            $tags = new Tag();
            $tags->category_id = $category_id;
            $tags->item_id = $item_id;
            $tags->save();
        }

        Session::flash('message','Item was created succesfully!');

        return redirect()->route('user.items', Auth::user());
    }


    public function show($user_id, $item_id)
    {
        $item = Item::where('id', $item_id)->first();
        return view('user.items.show')->with('item', $item);
    }


    public function edit($user_id, $item_id)
    {
        $item = Item::where('id', $item_id)->where('user_id', $user_id)->first();
        return view('user.items.edit')
            ->with('item', $item);
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($user, $item)
    {
        $item = Item::where('id', $item)->where('user_id', $user)->first();
        $item->delete();

        $items = Item::where('user_id', $user)->get();
        return view('user.items')->with('bankAccounts', $items);
    }
}

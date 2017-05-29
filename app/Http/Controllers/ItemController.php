<?php

namespace App\Http\Controllers;

use App\Auction_Winner;
use App\Category;
use App\Favorite;
use App\Product;
use App\Mailing_Service;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
            'quantity' => 'required_if:type,1',
            'price' => 'required_if:type,1'
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        $type = Input::get('type');
        $user_id = Auth::user()->id;
        $title = Input::get('title');
        $description = Input::get('description');
        $submittedMailingServices = Input::get('mailing_services');
        $submittedCategories = Input::get('categories');
        if(Input::hasFile('picture')){
            $picture = Input::file('picture');
            $picture->move('products/', $picture->getClientOriginalName());
            $picturePath = 'products/' . $picture->getClientOriginalName();
        }

        $item = new Product();

        if($type == 0){
            $expirationDate = Input::get('expirationDate');
            $startingBid = Input::get('startingBid');
            $item->createAuction($user_id, $title, $type, $description, $expirationDate,$startingBid, $submittedMailingServices, $picturePath, $submittedCategories);
        }else{
            $quantity = Input::get('quantity');
            $price = Input::get('price');
            $item->createRegularItem($user_id, $title, $type, $description, $quantity, $price, $submittedMailingServices, $picturePath, $submittedCategories);
        }

        Session::flash('message','Product was created succesfully!');

        return redirect()->route('user.listedItems', Auth::user());
    }


    public function show($id)
    {
        $item = Product::where('id', $id)->first();
        if($item->blocked){
            if(Auth::user()->id == $item->user_id){
                return view('items.show')->with('item', $item);
            }else{
                return redirect()->route('welcome');
            }
        }
        return view('items.show')->with('item', $item);
    }


    public function edit($id)
    {
        $item = Product::find($id);
        if($item->user_id == Auth::user()->id){
            return view('items.edit')
                ->with('item', $item);
        }else{
            return redirect()->route('welcome');
        }

    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_title' => 'required',
            'product_description' => 'required'
        ]);

        $item = Product::find($id);
        $item->title = $request->get('product_title');
        $item->description = $request->get('product_description');
        $item->save();

        Session::flash('message','Product was successfully updated!');
        return redirect()->route('user.listedItems', Auth::user());

    }


    public function destroy($id)
    {
        $item = Product::find($id);
        $item->delete();

        if(File::exists($item->picture)){
            File::delete($item->picture);
        }

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
                ->where('blocked', '!=', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(9);
        }else{
            $items = Product::where('type', 1)
                ->where('blocked', '!=', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(9);
        }

        return view('items.index')->with('items', $items);
    }

    public function extendExpirationDate(Request $request, $id){
        $item = Product::find($id);
        $newDate = Carbon::parse($request->get('expirationDate'), 'Europe/Riga');

        $item->expirationDate = $newDate;
        $item->save();

        Session::flash('message', 'Successfully extended auction time!');
        return back();
    }

    public function payForWonAuction(Request $request, $id){
        $win = Auction_Winner::where('item_id', $id)->first();
        $win->hasPaid = 1;
        $win->save();

        Session::flash('message', 'Successfully paid for the product!');
        return back();
    }

    public function buyRegularItem(Request $request, Product $item){
        $this->validate($request, [
            'quantityEntered' => 'required'
        ]);

        if($request->get('quantityEntered') > $item->quantity){
            return back()->withErrors('The quantity cannot be higher than ' . $item->quantity);
        }else{
            $item->quantity = $item->quantity - intval($request->get('quantityEntered'));
            $item->save();

            Session::flash('message', 'Successfully bought the item!');
            return back();
        }
    }
}

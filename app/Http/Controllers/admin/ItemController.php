<?php

namespace App\Http\Controllers\admin;

use App\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ItemController extends Controller
{
    public function index(){
        $items = Product::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.items.index')->with('items', $items);
    }

    public function destroy($id){
        $item = Product::findOrFail($id);
        $item->delete();

        if(File::exists($item->picture)){
            File::delete($item->picture);
        }

        Session::flash('message','Product was deleted');
    }

    public function block_unblock($id){
        $item = Product::findOrFail($id);
        if($item->blocked){
            $item->blocked = 0;
        }else{
            $item->blocked = 1;
        }
        $item->save();

        $success = true;

        return response($success);
    }
}

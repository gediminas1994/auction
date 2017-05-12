<?php

namespace App\Http\Controllers\admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::where('parent_id', null)->get();
        $subcategories = Category::where('parent_id', '!=', null)->get();
        return view('admin.categories.index')
            ->with('categories', $categories)
            ->with('subcategories', $subcategories);
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required'
        ]);

        if($request->input('type') == 'category'){
            $category = new Category();
            $category->title = $request->input('title');
            $category->parent_id = null;
            $category->save();
            Session::flash('message','Sucesfully created a new category');
        }else{
            $subcategory = new Category();
            $subcategory->title = $request->input('title');
            $subcategory->parent_id = $request->input('parent_id');
            $subcategory->save();
            Session::flash('message','Sucesfully created a new subcategory');
        }

        return back();
    }

    public function destroy($id){
        $category = Category::findOrFail($id);
        $deleted = $category->delete();

        if($deleted){
            Session::flash('message','Sucesfully deleted');
            return response()->json(true);
        }else{
            return response()->json(false);
        }

    }
}

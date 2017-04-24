<?php
namespace App\Http\ViewComposers;

use App\Category;
use Illuminate\View\View;

class SideMenuComposer
{
    protected $categories;

    public function __construct(Category $categories)
    {
        // Dependencies automatically resolved by service container...
        $this->categories = $categories;
    }

    public function compose(View $view)
    {
        $categories = $this->categories->where('parent_id', null)->get();
        $subcategories = $this->categories->where('parent_id', '!=', null)->get();
        $view->with('categories', $categories)->with('subcategories', $subcategories);
    }
}
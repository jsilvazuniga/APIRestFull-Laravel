<?php

namespace App\Http\Controllers\Category;

use App\Seller;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategorySellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $sellers = $category->products()
                    ->with('sellers')
                    ->get()
                    ->pluck('sellers')
                    ->unique('id')
                    ->values();

        return $this->showAll($sellers);
    }

 
}

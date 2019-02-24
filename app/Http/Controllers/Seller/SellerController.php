<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$sellers = Seller::has('products')->get();
      //se hace por el scope
      $sellers = Seller::all();
      
       // return response()->json(['data' => $sellers], 200);
        return $this->showAll($sellers);
    }

   

    /**
     * Display the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
      //  return response()->json(['data' => $seller], 200);
      return $this->showOne($seller);
    }

   

   
}

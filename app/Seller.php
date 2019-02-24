<?php

namespace App;

use App\User;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\SellerScope;
use App\Http\Resources\SellerResource;

class Seller extends User
{
    public $resource = SellerResource::class;

    protected static function boot(){
        /*se invoca cada inicio de cualquier metodo*/ 
        parent::boot();
        
        static::addGlobalScope(new SellerScope);
    }

    public function products()
    {
        //un seller tiene muchos productos
        return $this->hasMany(Product::class);
    }   
}

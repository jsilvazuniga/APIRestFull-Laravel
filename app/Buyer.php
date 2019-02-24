<?php

namespace App;

use App\User;
use App\Transaction;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\BuyerScope;
use App\Http\Resources\BuyerResource;

class Buyer extends User
{   
    public $resource = BuyerResource::class;

    protected static function boot(){
        /*se invoca cada inicio de cualquier metodo*/ 
        parent::boot();
        
        static::addGlobalScope(new BuyerScope);
    }

    public function transactions()
    {   /*un buyer tiene muchas transactiones*/ 
        return $this->hasMany(Transaction::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','email', 'email_verified_at'
    ];
}

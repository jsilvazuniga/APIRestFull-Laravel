<?php

namespace App;

use App\Seller;
use App\Transaction;
use App\Category;
use App\Http\Resources\ProductResource;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $resource = ProductResource::class;

    const AVAILABLE = 'available';
    const NOT_AVAILABLE = 'no available';
    
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'status',
        'seller_id'
    ];

          /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pivot',
    ];
    
    public function seller()
    {   //tiene un seller
        return $this->belongsTo(Seller::class);
    }


    public function transactions()
    {   //un producto esta en una transaction
        return $this->hasMany(Transaction::class);
    }


    public function categories()
    {   //una categoria puede tener varios productos
        return $this->belongsToMany(Category::class);
    }

}

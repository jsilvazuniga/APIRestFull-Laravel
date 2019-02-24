<?php

namespace App;

use App\Buyer;
use App\Product;
use App\Http\Resources\TransactionResource;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $resource = TransactionResource::class;

    protected $fillable = [
        'quantity',
        'buyer_id',
        'product_id'
    ];

    public function buyer()
    {   //una transaction pertenece a un comprador 
        return $this->belongsTo(Buyer::class);
    }

    public function product()
    {  //tiene un producto
        return $this->belongsTo(Product::class);
    }
}

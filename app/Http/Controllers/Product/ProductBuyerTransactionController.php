<?php

namespace App\Http\Controllers\Product;

use App\User;
use App\Product;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;

class ProductBuyerTransactionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product, User $buyer)
    {   /*
        $request->validate([
             'quantity' => 'required|integer|min:1'           
        ]);*/

      $rules = [
            'quantity' => 'required|integer|min:1'           
                ];

        $data = $this->transformAndValidatedRequest(TransactionResource::class, $request, $rules);
        
        if($buyer->id === $product->seller_id){
            return $this->errorResponse('the buyer must be different from the seller'
                        , 409);
        }

        if($product->status === Product::NOT_AVAILABLE){
            return $this->errorResponse('the product is not available'
                        , 409);
        }

        if($product->quantity <  $data['quantity'] ){
            return $this->errorResponse('the product does not enough units for this transaction'
                        , 409);
        }

        $product->quantity -= $data['quantity'];
        $product->save();

        $transaction = Transaction::create([
            'quantity' => $data['quantity'],
            'buyer_id' => $buyer->id,
            'product_id' => $product->id,            
        ]);

        return $this->showOne($transaction, 201);

    }

}

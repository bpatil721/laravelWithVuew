<?php

namespace Modules\Cart\Repositories;
use Modules\Cart\Interface\CartRepositoryInterface;
use Modules\Cart\Models\Cart;
use Auth;

class CartRepository implements CartRepositoryInterface
{
    
    public function Store($request) {
      return Cart::create([
        'product_id' => $request->product_id,
        'quantity'   => $request->quantity,
        'amount' => $request->amount,
        'user_id' => auth()->id()
        // add user_id if required
    ]);
    }
}

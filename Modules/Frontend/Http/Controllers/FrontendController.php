<?php

namespace Modules\Frontend\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Cart\Models\Cart;
use Auth;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend::index');
    }

    public function create()
    {
        return view('frontend::create');
    }

    public function store(Request $request) {}

    public function show($id)
    {
        return view('frontend::show');
    }

    public function edit($id)
    {
        return view('frontend::edit');
    }

    public function update(Request $request, $id) {}

    public function home()
    {
        return view('frontend::home');
    }

    public function destroy($id) {}

    public function getCheckout()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $total = $cartItems->sum(fn($item) => $item->amount);

        return view('frontend::checkout', compact('cartItems', 'total'));
    }
}

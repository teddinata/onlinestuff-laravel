<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;  // Add this line
use Illuminate\Support\Facades\Auth;  // Add this line

class CartController extends Controller
{
    public function addToCart($productId, $quantity)
    {
        $user = Auth::user();

        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->update(['quantity' => $cartItem->quantity + $quantity]);
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }
}

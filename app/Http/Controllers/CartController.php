<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Product;
use App\Models\Province;
use App\Models\City;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class CartController extends Controller
{
    private function formatPrice($price)
    {
        return number_format($price, 0, ',', '.');
    }

    public function index()
    {
        $user = Auth::user();
        $categories = Category::all();

        if (Auth::check()) {
            $user = Auth::user();
            $cartItems = Cart::with('product')->where('user_id', $user->id)->get();
        } else {
            $cartItems = collect(); // empty collection
        }

        $totalPrice = $cartItems->sum(function ($cartItem) {
            $price = $cartItem->product->discount_price > 0
                ? $cartItem->product->discount_price
                : $cartItem->product->price;

            return $price * $cartItem->quantity;
        });

        $totalPriceFormatted = $this->formatPrice($totalPrice);

        return view('pages.frontend.cart', [
            'categories' => $categories,
            'cartItems' => $cartItems,
            'cartItemsCount' => $cartItems->count(),
            'totalPriceFormatted' => $totalPriceFormatted,
        ]);
    }

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

    public function removeFromCart($id)
    {
        $user = Auth::user();

        $cartItem = Cart::where('user_id', $user->id)
            ->where('id', $id)
            ->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('success', 'Product removed from cart successfully.');
            // Session::flash('success', 'Product removed from cart successfully.');
        } else {
            return redirect()->back()->with('error', 'Product not found in cart.');
            // Session::flash('error', 'Product not found in cart.');
        }

        // return redirect()->back();
    }

    // checkout to update cart
    // public function updateCart(Request $request)
    // {
    //     $user = Auth::user();

    //     $cartItem = Cart::where('user_id', $user->id)
    //         ->where('id', $request->cartItemId)
    //         ->first();

    //     if ($cartItem) {
    //         $cartItem->update(['quantity' => $request->quantity]);
    //         return redirect()->back()->with('success', 'Cart updated successfully.');
    //     } else {
    //         return redirect()->back()->with('error', 'Product not found in cart.');
    //     }
    // }

    public function updateCart(Request $request)
    {
        try {
            $cartData = $request->input('cart');

            foreach ($cartData as $item) {
                $productId = $item['productId'];
                $quantity = $item['quantity'];

                $user = Auth::user();

                $cartItem = Cart::where('user_id', $user->id)
                    ->where('product_id', $productId)
                    ->first();

                if ($cartItem) {
                    // If the item exists in the cart, update the quantity
                    $cartItem->update(['quantity' => $quantity]);
                } else {
                    // If the item doesn't exist, create a new cart item
                    Cart::create([
                        'user_id' => $user->id,
                        'product_id' => $productId,
                        'quantity' => $quantity,
                    ]);
                }
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function checkout()
    {
        $user = Auth::user();
        $categories = Category::all();
        $provinces = Province::pluck('name', 'province_id');

        if (Auth::check()) {
            $user = Auth::user();
            $cartItems = Cart::with('product')->where('user_id', $user->id)->get();
        } else {
            $cartItems = collect(); // empty collection
        }

        $totalPrice = $cartItems->sum(function ($cartItem) {
            $price = $cartItem->product->discount_price > 0
                ? $cartItem->product->discount_price
                : $cartItem->product->price;

            return $price * $cartItem->quantity;
        });

        $totalPriceFormatted = $this->formatPrice($totalPrice);

        return view('pages.frontend.checkout', [
            'categories' => $categories,
            'provinces' => $provinces,
            'cartItems' => $cartItems,
            'cartItemsCount' => $cartItems->count(),
            'totalPriceFormatted' => $totalPriceFormatted,
        ]);
    }

    // checkout process
    public function checkoutProcess(CheckoutRequest $request)
    {
        $user = Auth::user();
        // dd($request->all());

        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        $totalPrice = $cartItems->sum(function ($cartItem) {
            $price = $cartItem->product->discount_price > 0
                ? $cartItem->product->discount_price
                : $cartItem->product->price;

            return $price * $cartItem->quantity;
        });

        $totalPriceFormatted = $this->formatPrice($totalPrice);

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        // generate invoice code
        $transaction->invoice_code = 'DST-' . time() . '-' . $user->id . '-' . rand(100, 999);
        $transaction->name = $request->name;
        $transaction->phone = $request->phone;
        $transaction->address = $request->address;
        $transaction->province_id = $request->province_id;
        $transaction->regency_id = $request->regency_id;
        $transaction->district_id = $request->district_id;
        $transaction->village_id = $request->village_id;
        $transaction->postal_code = $request->postal_code;
        $transaction->courier = $request->courier;
        $transaction->courier_service = $request->courier_service;
        $transaction->insurance_price = $request->insurance_price;
        $transaction->shipping_price = $request->shipping_cost;
        $transaction->estimated_arrival = $request->etd;
        $transaction->total_amount = $request->grand_total;
        $transaction->payment_method = $request->payment_method;
        $transaction->payment_status = 'pending';
        $transaction->shipping_status = 'packing';
        $transaction->save();

        foreach ($cartItems as $cartItem) {
            $transaction->details()->create([
                'product_id' => $cartItem->product->id,
                'price' => $cartItem->product->price,
                'qty' => $cartItem->quantity,
                'weight' => $cartItem->product->weight,
                'total_amount' => $cartItem->product->price * $cartItem->quantity,
            ]);
        }

        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('checkout.success', $transaction->id);
    }

    public function checkoutSuccess($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('pages.frontend.success', [
            'transaction' => $transaction,
        ]);
    }

    public function getCities($id)
    {
        $city = City::where('province_id', $id)->pluck('name', 'city_id');
        return response()->json($city);
    }

    public function check_ongkir(Request $request)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => 105,
            'destination'   => $request->regency_id, // ID kota/kabupaten tujuan
            'weight'        => 1000,
            'courier'       => $request->courier // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();


        return response()->json($cost);
    }


}

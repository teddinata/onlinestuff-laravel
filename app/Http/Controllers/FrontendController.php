<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;

class FrontendController extends Controller
{
    private function formatPrice($price)
    {
        return number_format($price, 0, ',', '.');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $categories = Category::all();

        // $cartItems = \Cart::session(auth()->id())->getContent();
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();
        $totalPrice = $cartItems->sum(function ($cartItem) {
            $price = $cartItem->product->discount_price > 0
                ? $cartItem->product->discount_price
                : $cartItem->product->price;

            return $price * $cartItem->quantity;
        });
        $totalPriceFormatted = $this->formatPrice($totalPrice);

        // product
        $products = Product::orderBy('created_at', 'DESC')->limit(8)->get();

        return view('pages.frontend.index', [
            'categories' => $categories,
            'products' => $products,
            'cartItems' => $cartItems,
            'cartItemsCount' => $cartItems->count(),
            'totalPriceFormatted' => $totalPriceFormatted,
        ]);
    }

    public function shop(Request $request, string $categorySlug = null)
    {
        $categories = Category::all();

        $query = Product::query();

        if ($categorySlug) {
            $category = Category::where('slug', $categorySlug)->first();
            $query->where('category_id', $category->id);
        }

        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

         // Filter by keyword search
         // Filter by keyword search
        $keyword = $request->get('keyword');
        if ($keyword) {
            $query->where('name', 'LIKE', "%$keyword%");
        }

        $products = $query->get();


        return view('pages.frontend.shop', [
            'categories' => $categories,
            'products' => $products,
            'categorySlug' => $categorySlug,
            'keyword' => $keyword,
        ]);
    }

    public function productDetail($slug)
    {
        $categories = Category::all();
        // Retrieve the product based on the slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // related products
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        // You can add any additional logic here

        // Pass the product to the view
        return view('pages.frontend.detail', compact('product', 'categories', 'relatedProducts'));
    }

    public function about()
    {
        $categories = Category::all();

        return view('pages.frontend.about-us', [
            'categories' => $categories,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

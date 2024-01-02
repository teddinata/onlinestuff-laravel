<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\Product;
// request
use App\Http\Requests\GalleryRequest;
use Yajra\DataTables\Facades\DataTables;
// storage
use Illuminate\Support\Facades\Storage;


class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax()) {
            $gallery = Gallery::all();

            return DataTables::of($gallery)
            ->addColumn('product_name', function ($gallery) {
                return $gallery->product->name;
            })
            ->addColumn('action', function($gallery) {
                // tailwind
                return '
                <a href="'.route('gallery.edit', $gallery->id).'" class="inline-block bg-indigo-500 hover:bg-indigo-700 text-white font-bold px-2 py-1 m-1 rounded-md select-none ease focus:outline-none focus:shadow-outline">Edit</a>
                <form action="'.route('gallery.destroy', $gallery->id).'" method="POST" class="inline-block" style="margin: 0; padding: 0;" onsubmit="return confirm(\'Are you sure you want to delete this item?\');">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold px-2 py-1 m-1 rounded-md select-none ease focus:outline-none focus:shadow-outline">Delete</button>
                </form>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('pages.dashboard.gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         // fetch product
         $products = Product::all();

         // return view
         return view('pages.dashboard.gallery.create', [
             'products' => $products,
         ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryRequest $request)
    {
        // upload image
        $image = $request->file('image')->store('assets/product', 'public');

        // create gallery
        Gallery::create([
            'product_id' => $request->product_id,
            'image' => $image,
            'caption' => $request->caption,
        ]);

        // redirect
        return redirect()->route('gallery.index')->with('success', 'Gallery created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        // fetch product
        $products = Product::all();

        // return view
        return view('pages.dashboard.gallery.edit', [
            'item' => $gallery,
            'products' => $products,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryRequest $request, Gallery $gallery)
    {
        // get all request
        $data = $request->all();

        // check if request has image
        if($request->hasFile('image')) {
            // delete old image
            Storage::disk('public')->delete($gallery->image);

            // upload new image
            $data['image'] = $request->file('image')->store('assets/product', 'public');
        }

        // update gallery
        $gallery->update($data);

        // redirect
        return redirect()->route('gallery.index')->with('success', 'Gallery updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        // delete image
        Storage::disk('public')->delete($gallery->image);

        // delete gallery
        $gallery->delete();

        // redirect
        return redirect()->route('gallery.index')->with('success', 'Gallery deleted successfully');
    }
}

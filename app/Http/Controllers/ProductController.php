<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::get();

        // dd($products); // Cek apakah ini objek yang benar

        return view('products.index', ['products' => $products]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Data baru yang akan ditambahkan
        $product = Product::create([
        'name' => $request->name,
        'gender' => $request->gender,
        'category' => $request->category,
        'subcategory' => $request->subcategory,
        'price' => $request->price,
        'discount'=> $request->discount,
        'image1' => $request->image1,
        'image2' => $request->image2,
        'image3' => $request->image3,
        'description' => $request->description,
        ]);



        // Redirect atau tampilkan pesan sukses
        return redirect()->route('products.list')->with('success', 'Produk berhasil disimpan!');
    }

    public function show($id)
    {
        // Cek produk berdasarkan ID
        $product = Product::find($id);

        // Pastikan produk ditemukan
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Produk tidak ditemukan!');
        }

        // Kirimkan data produk ke view
        return view('products.show', ['product' => $product]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // $product = collect($this->products)->firstWhere('id', $id);

        // if (!$product) {
        //     return redirect()->route('products.index')->with('error', 'Product not found!');
        // } else {};

        // return view('products.edit', ['product' => $product]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id' => 'required|max:5',
            'name' => 'nullable|string|max:50',
            'price' => 'nullable|numeric',
            'disc' => 'nullable|numeric',
            'category' => 'nullable|string|max:50',
            'subCategory'=> 'nullable|string|max:50',
        ]);

         // Cek apakah produk ada di array
        //  if (!isset($this->products[$id])) {
        //     return response()->json(['error' => 'Product not found'], 404);
        // }

        // // Update produk dalam array, hanya jika input tidak null
        // if (isset($validated['name'])) {
        //     $this->products[$id]['name'] = $validated['name'];
        // }

        // if (isset($validated['price'])) {
        //     $this->products[$id]['price'] = $validated['price'];
        // }

        // if (isset($validated['disc'])) {
        //     $this->products[$id]['disc'] = $validated['disc'];
        // }

        // if (isset($validated['category'])) {
        //     $this->products[$id]['category'] = $validated['category'];
        // }

        // if (isset($validated['subCategory'])) {
        //     $this->products[$id]['subCategory'] = $validated['subCategory'];
        // }

        // return redirect()->route('products.show', ['id' => $id])->with('success', 'Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

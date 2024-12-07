<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public $products = array(
        ["id"=> "1234a",
        "category"=>"Pria Sportswear",
        "subCategory"=> "SEPATU",
        "name"=> "ULTIMASHOW 2.0",
        "price"=> 900000,
        "disc"=> 30,
        "image"=> "https://fastly.picsum.photos/id/902/350/350.jpg?hmac=VGy50trdETKDp9Rtt5brwMQ7JYG7S3kZHCvy5slG1Io",
        "otherImage"=>"https://fastly.picsum.photos/id/626/350/350.jpg?hmac=LnDvOPY_RWw3EbQJEIZrg1ZBUdG2UhwhuuzL5oGVr0k"],

        ["id"=> "1234b",
        "category"=>"Wanita Originals",
        "subCategory"=> "SEPATU",
        "name"=> "ADIDAS SLEEK",
        "price"=> 1200000,
        "disc"=> 30,
        "image"=> "https://fastly.picsum.photos/id/902/350/350.jpg?hmac=VGy50trdETKDp9Rtt5brwMQ7JYG7S3kZHCvy5slG1Io",
        "otherImage"=>"https://fastly.picsum.photos/id/626/350/350.jpg?hmac=LnDvOPY_RWw3EbQJEIZrg1ZBUdG2UhwhuuzL5oGVr0k"],
    );

    public function index()
    {
        return view('products.index', ['products' => $this->products]);
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
        // Use array_filter to find the product by id
        $Product = collect($this->products)->firstWhere('id', $id);

        if (!$Product) {
            return redirect()->route('products.index')->with('error', 'Product not found!');
        } else {};

        return view('products.show', ['product' => $Product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = collect($this->products)->firstWhere('id', $id);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found!');
        } else {};

        return view('products.edit', ['product' => $product]);
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
         if (!isset($this->products[$id])) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Update produk dalam array, hanya jika input tidak null
        if (isset($validated['name'])) {
            $this->products[$id]['name'] = $validated['name'];
        }

        if (isset($validated['price'])) {
            $this->products[$id]['price'] = $validated['price'];
        }

        if (isset($validated['disc'])) {
            $this->products[$id]['disc'] = $validated['disc'];
        }

        if (isset($validated['category'])) {
            $this->products[$id]['category'] = $validated['category'];
        }

        if (isset($validated['subCategory'])) {
            $this->products[$id]['subCategory'] = $validated['subCategory'];
        }

        return redirect()->route('products.show', ['id' => $id])->with('success', 'Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

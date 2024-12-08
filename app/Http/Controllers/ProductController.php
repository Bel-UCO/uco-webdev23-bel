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

        foreach ($products as $product) {
            // Jika ada image1, encode ke base64
            if ($product->image1) {
                // Tentukan tipe MIME gambar yang benar (misal image/jpeg atau image/png)
                $imageType = 'image/jpeg'; // Sesuaikan dengan tipe file gambar Anda
                $encodedImage = base64_encode($product->image1);

                // Membuat base64 data URL
                $product->image1_base64 = 'data:' . $imageType . ';base64,' . $encodedImage;
            }
        }

        // dd($products);

        return view('products.index', compact('products'));
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
        // $processed_image1 -> image1

        if ($request->hasFile('image1')) {
            $image1 = file_get_contents($request->file('image1')->getRealPath());
        } else {
            $image1 = null;
        }

        if ($request->hasFile('image2')) {
            $image2 = file_get_contents($request->file('image2')->getRealPath());

        } else {
            $image2 = null;
        }

        if ($request->hasFile('image3')) {
            $image3 = file_get_contents($request->file('image3')->getRealPath());

        } else {
            $image3 = null;
        }


        // Data baru yang akan ditambahkan
        $product = Product::create([
        'name' => $request->name,
        'gender' => $request->gender,
        'category' => $request->category,
        'subcategory' => $request->subcategory,
        'price' => $request->price,
        'discount'=> $request->discount,
        'image1' => $image1,
        'image2' => $image2,
        'image3' => $image3,
        'description' => $request->description,
        ]);



        // Redirect atau tampilkan pesan sukses
        return redirect()->route('products.list')->with('success', 'Produk berhasil disimpan!');
    }

    public function image1($id)
    {
        // Fetch the product by ID
        $product = Product::findOrFail($id);

        // Get the image from the database (BLOB)
        $image1 = $product->image1;

        // If no image is found, return a placeholder image
        if (!$image1) {
            abort(404, 'Image not found');
        }

        // Determine the MIME type of the image (you can adjust this based on your needs)
        $mimeType = 'image/jpeg'; // Change as necessary (you can add a check for PNG, GIF, etc.)

        // Return the image as a response with the appropriate MIME type
        return response($image1, 200)
            ->header('Content-Type', $mimeType);
    }

    public function image2($id)
    {
        // Fetch the product by ID
        $product = Product::findOrFail($id);

        // Get the image from the database (BLOB)
        $image2 = $product->image2;

        // If no image is found, return a placeholder image
        if (!$image2) {
            abort(404, 'Image not found');
        }

        // Determine the MIME type of the image (you can adjust this based on your needs)
        $mimeType = 'image/jpeg'; // Change as necessary (you can add a check for PNG, GIF, etc.)

        // Return the image as a response with the appropriate MIME type
        return response($image2, 200)
            ->header('Content-Type', $mimeType);
    }

    public function image3($id)
    {
        // Fetch the product by ID
        $product = Product::findOrFail($id);

        // Get the image from the database (BLOB)
        $image3 = $product->image3;

        // If no image is found, return a placeholder image
        if (!$image3) {
            abort(404, 'Image not found');
        }

        // Determine the MIME type of the image (you can adjust this based on your needs)
        $mimeType = 'image/jpeg'; // Change as necessary (you can add a check for PNG, GIF, etc.)

        // Return the image as a response with the appropriate MIME type
        return response($image3, 200)
            ->header('Content-Type', $mimeType);
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

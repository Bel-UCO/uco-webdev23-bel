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
    // Handle image uploads
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

    // Formatting fields before saving
    $name = strtoupper($request->name);  // Convert all characters to uppercase
    $subcategory = strtoupper($request->subcategory);  // Convert all characters to uppercase
    $category = ucwords(strtolower($request->category));  // Convert to camel case (first letter capitalized, the rest lowercase)

    // Data baru yang akan ditambahkan
    $product = Product::create([
        'name' => $name,
        'gender' => $request->gender,
        'category' => $category,
        'subcategory' => $subcategory,
        'price' => $request->price,
        'discount' => $request->discount,
        'image1' => $image1,
        'image2' => $image2,
        'image3' => $image3,
        'description' => $request->description,
    ]);

    // Return the response
    return redirect()->route('products.list')->with('success', 'Product created successfully!');
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
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404); // Tanda titik koma di sini
        }

        return view('products.edit', ['product' => $product]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if ($product) {
            // Mengecek dan mengupdate hanya jika data request tidak kosong atau hanya spasi
            if (!empty(trim($request->name))) {
                $product->name = $request->name;
            }

            if (!empty(trim($request->gender))) {
                $product->gender = $request->gender;
            }

            if (!empty(trim($request->category))) {
                $product->category = $request->category;
            }

            if (!empty(trim($request->subcategory))) {
                $product->subcategory = $request->subcategory;
            }

            if (!empty(trim($request->price))) {
                $product->price = $request->price;
            }

            if (!empty(trim($request->discount))) {
                $product->discount = $request->discount;
            }

            if (!empty(trim($request->description))) {
                $product->description = $request->description;
            }

            // Mengecek file gambar, jika ada, ambil kontennya, jika tidak, set null
            if ($request->hasFile('image1')) {
                $image1 = file_get_contents($request->file('image1')->getRealPath());
                $product->image1 = $image1;
            } else {
                // Jika tidak ada gambar baru, jangan ubah image1
                $image1 = $product->image1; // Biarkan gambar yang lama tetap ada
            }

            if ($request->hasFile('image2')) {
                $image2 = file_get_contents($request->file('image2')->getRealPath());
                $product->image2 = $image2;
            } else {
                // Jika tidak ada gambar baru, jangan ubah image2
                $image2 = $product->image2; // Biarkan gambar yang lama tetap ada
            }

            if ($request->hasFile('image3')) {
                $image3 = file_get_contents($request->file('image3')->getRealPath());
                $product->image3 = $image3;
            } else {
                // Jika tidak ada gambar baru, jangan ubah image3
                $image3 = $product->image3; // Biarkan gambar yang lama tetap ada
            }

            // Menyimpan perubahan hanya jika ada perubahan
            $product->save();
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }


        return redirect()->route('products.show', ['id' => $id])->with('success', 'Product updated successfully');

    }

    public function search(Request $request)
    {
        // Ambil keyword dari input request
        $keyword = $request->input('keyword');

        // Pecah kata kunci menjadi array berdasarkan spasi
        $keywords = explode(' ', $keyword);

        // Mulai query pencarian
        $query = Product::query();

        // Loop untuk setiap kata kunci dan tambahkan pencarian ke query
        foreach ($keywords as $word) {
            $query->where(function($query) use ($word) {
                $query->where('name', 'like', '%' . trim($word) . '%')
                    ->orWhere('description', 'like', '%' . trim($word) . '%');
            });
        }

        // Ambil hasil pencarian
        $products = $query->get();

        // Jika tidak ada hasil pencarian
        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found'], 404);
        }

        // Kembalikan hasil pencarian ke view atau dalam format JSON
        return view('products.index', ['products' => $products]);
    }




    public function destroy(string $id)
    {
        //
    }
}

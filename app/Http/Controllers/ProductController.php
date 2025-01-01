<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        // Ambil semua produk beserta kategori (relasi)
        $products = Product::with('category');

        // Filter berdasarkan kategori jika ada
        if ($request->has('category')) {
            $products = $products->where('category_id', $request->category);
        }

        // Sorting berdasarkan parameter jika ada
        if ($request->has('sort_by')) {
            if ($request->sort_by == 'price_asc') {
                $products = $products->orderByRaw('price - (price * discount / 100) ASC');
            } elseif ($request->sort_by == 'price_desc') {
                $products = $products->orderByRaw('price - (price * discount / 100) DESC');
            } elseif ($request->sort_by == 'name_asc') {
                $products = $products->orderBy('name', 'asc');
            } elseif ($request->sort_by == 'name_desc') {
                $products = $products->orderBy('name', 'desc');
            }
        }

        // Filter harga berdasarkan rentang harga jika ada
        if ($request->has('min_price') && $request->has('max_price')) {
            // dd($request->min_price, $request->max_price);
            $products = $products->whereRaw('price - (price * discount / 100) BETWEEN ? AND ?', [$request->min_price, $request->max_price]);
        }

        // Ambil data produk
        $products = $products->get();

        // Encode image jika ada
        foreach ($products as $product) {
            if ($product->image1) {
                $imageType = 'image/jpeg'; // Tentukan MIME type sesuai dengan jenis gambar
                $encodedImage = base64_encode($product->image1);
                $product->image1_base64 = 'data:' . $imageType . ';base64,' . $encodedImage;
            }
        }

        $showFilters = true; // Filter akan ditampilkan di halaman produk

        // Kirim data ke view
        return view('products.index', compact('products', 'showFilters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::getOrdered();

        $showFilters = false;

    // Mengirim data kategori ke view
        return view('products.create', compact('categories', 'showFilters'));
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

    // Data baru yang akan ditambahkan
    $product = Product::create([
        'name' => $name,
        'gender' => $request->gender,
        'category_id' => $request->category_id,
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
            return redirect()->route('products.list')->with('error', "There's no product with such ID.");
        }

        $category = $product->category;

        if (!$category) {
            return redirect()->route('products.list')->with('error', "There's no product with such ID.");
        }

        $showFilters = false;

        // Kirimkan data produk ke view
        // dd($showFilters);
        // return view('products.show', ['product' => $product, 'category'=> $category, 'showFilters' => $showFilters]);
        return view('products.show', [
            'product' => $product,
            'category' => $category,
            'showFilters' => $showFilters
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Mengambil produk berdasarkan ID
        $product = Product::find($id);

        // Mengambil semua kategori untuk dropdown
        $categories = Category::getOrdered();

        if (!$product) {
            return redirect()->route('products.form')->with('error', "There's no product with such ID.")
    ->with('debug', session()->all());
        }

        // Mengirim data produk dan kategori ke view
        return view('products.edit', [
            'product' => $product,
            'categories' => $categories,
            'showFilters' => false
        ]);
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

            if (!empty(trim($request->category_id))) {
                $product->category_id = $request->category_id;
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
        // if ($products->isEmpty()) {
        //     return response()->json(['message' => 'No products found'], 404);
        // }

        // Kembalikan hasil pencarian ke view atau dalam format JSON
        return view('products.index', ['products' => $products, 'showFilters' => true]);
    }




    public function destroy(string $id)
    {
        //
    }
}

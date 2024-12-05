<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        ["id"=> "1234c",
        "category"=>"Anak Originals",
        "subCategory"=> "SEPATU",
        "name"=> "SUPERSTAR HOME ICONS",
        "price"=> 1100000,
        "disc"=> 30,
        "image"=> "https://fastly.picsum.photos/id/902/350/350.jpg?hmac=VGy50trdETKDp9Rtt5brwMQ7JYG7S3kZHCvy5slG1Io",
        "otherImage"=>"https://fastly.picsum.photos/id/626/350/350.jpg?hmac=LnDvOPY_RWw3EbQJEIZrg1ZBUdG2UhwhuuzL5oGVr0k"],

        ["id"=> "1234d",
        "category"=>"Wanita Running",
        "subCategory"=> "SEPATU",
        "name"=> "DURAMO SL",
        "price"=> 900000,
        "disc"=> 30,
        "image"=> "https://fastly.picsum.photos/id/902/350/350.jpg?hmac=VGy50trdETKDp9Rtt5brwMQ7JYG7S3kZHCvy5slG1Io",
        "otherImage"=>"https://fastly.picsum.photos/id/626/350/350.jpg?hmac=LnDvOPY_RWw3EbQJEIZrg1ZBUdG2UhwhuuzL5oGVr0k"],

        ["id"=> "1234e",
        "category"=>"Anak Training",
        "subCategory"=> "SOCKS",
        "name"=> "GRAPHIC",
        "price"=> 180000,
        "disc"=> 30,
        "image"=> "https://fastly.picsum.photos/id/902/350/350.jpg?hmac=VGy50trdETKDp9Rtt5brwMQ7JYG7S3kZHCvy5slG1Io",
        "otherImage"=>"https://fastly.picsum.photos/id/626/350/350.jpg?hmac=LnDvOPY_RWw3EbQJEIZrg1ZBUdG2UhwhuuzL5oGVr0k"],

        ["id"=> "1234f",
        "category"=>"Pria Tennis",
        "subCategory"=> "POLO SHIRT",
        "name"=> "TENIS CLUB 3-STRIPES",
        "price"=> 500000,
        "disc"=> 30,
        "image"=> "https://fastly.picsum.photos/id/902/350/350.jpg?hmac=VGy50trdETKDp9Rtt5brwMQ7JYG7S3kZHCvy5slG1Io",
        "otherImage"=>"https://fastly.picsum.photos/id/626/350/350.jpg?hmac=LnDvOPY_RWw3EbQJEIZrg1ZBUdG2UhwhuuzL5oGVr0k"],

        ["id"=> "1234g",
        "category"=>"Anak Lifestyle",
        "subCategory"=> "SANDALS",
        "name"=> "DISNEY WATER",
        "price"=> 650000,
        "disc"=> 30,
        "image"=> "https://fastly.picsum.photos/id/902/350/350.jpg?hmac=VGy50trdETKDp9Rtt5brwMQ7JYG7S3kZHCvy5slG1Io",
        "otherImage"=>"https://fastly.picsum.photos/id/626/350/350.jpg?hmac=LnDvOPY_RWw3EbQJEIZrg1ZBUdG2UhwhuuzL5oGVr0k"],

        ["id"=> "1234h",
        "category"=>"Wanita Training",
        "subCategory"=> "T-SHIRT",
        "name"=> "YOGA STAY BALANCED GRAPHIC",
        "price"=> 530000,
        "disc"=> 30,
        "image"=> "https://fastly.picsum.photos/id/902/350/350.jpg?hmac=VGy50trdETKDp9Rtt5brwMQ7JYG7S3kZHCvy5slG1Io",
        "otherImage"=>"https://fastly.picsum.photos/id/626/350/350.jpg?hmac=LnDvOPY_RWw3EbQJEIZrg1ZBUdG2UhwhuuzL5oGVr0k"],

        ["id"=> "1234i",
        "category"=>"Pria Golf",
        "subCategory"=> "POLO SHIRT",
        "name"=> "GO-TO MINI CREST PRINT",
        "price"=> 1160000,
        "disc"=> 30,
        "image"=> "https://fastly.picsum.photos/id/902/350/350.jpg?hmac=VGy50trdETKDp9Rtt5brwMQ7JYG7S3kZHCvy5slG1Io",
        "otherImage"=>"https://fastly.picsum.photos/id/626/350/350.jpg?hmac=LnDvOPY_RWw3EbQJEIZrg1ZBUdG2UhwhuuzL5oGVr0k"],

        ["id"=> "1234j",
        "category"=>"Wanita Originals",
        "subCategory"=> "SEPATU",
        "name"=> "ADIFOM STAN SMITH MULE",
        "price"=> 1200000,
        "disc"=> 30,
        "image"=> "https://fastly.picsum.photos/id/902/350/350.jpg?hmac=VGy50trdETKDp9Rtt5brwMQ7JYG7S3kZHCvy5slG1Io",
        "otherImage"=>"https://fastly.picsum.photos/id/626/350/350.jpg?hmac=LnDvOPY_RWw3EbQJEIZrg1ZBUdG2UhwhuuzL5oGVr0k"],

        ["id"=> "1234k",
        "category"=>"Anak Originals",
        "subCategory"=> "SEPATU",
        "name"=> "ADIDAS X DISNEY MARIDA",
        "price"=> 1200000,
        "disc"=> 30,
        "image"=> "https://fastly.picsum.photos/id/902/350/350.jpg?hmac=VGy50trdETKDp9Rtt5brwMQ7JYG7S3kZHCvy5slG1Io",
        "otherImage"=>"https://fastly.picsum.photos/id/626/350/350.jpg?hmac=LnDvOPY_RWw3EbQJEIZrg1ZBUdG2UhwhuuzL5oGVr0k"],

        ["id"=> "1234l",
        "category"=>"Pria Originals",
        "subCategory"=> "TRACK TOP",
        "name"=> "ADICOLOR WOVEN FIREBIRD",
        "price"=> 1400000,
        "disc"=> 30,
        "image"=> "https://fastly.picsum.photos/id/902/350/350.jpg?hmac=VGy50trdETKDp9Rtt5brwMQ7JYG7S3kZHCvy5slG1Io",
        "otherImage"=>"https://fastly.picsum.photos/id/626/350/350.jpg?hmac=LnDvOPY_RWw3EbQJEIZrg1ZBUdG2UhwhuuzL5oGVr0k"],

        ["id"=> "1234m",
        "category"=>"Uniseks Outdoor",
        "subCategory"=> "SEPATU",
        "name"=> "AIR TERREX JAWPAW SLIP-ON",
        "price"=> 900000,
        "disc"=> 30,
        "image"=> "https://fastly.picsum.photos/id/902/350/350.jpg?hmac=VGy50trdETKDp9Rtt5brwMQ7JYG7S3kZHCvy5slG1Io",
        "otherImage"=>"https://fastly.picsum.photos/id/626/350/350.jpg?hmac=LnDvOPY_RWw3EbQJEIZrg1ZBUdG2UhwhuuzL5oGVr0k"],

        ["id"=> "1234n",
        "category"=>"Pria Sportswear",
        "subCategory"=> "T-SHIRT",
        "name"=> "GRAFIS CODES BADGE OF SPORT",
        "price"=> 450000,
        "disc"=> 30,
        "image"=> "https://fastly.picsum.photos/id/902/350/350.jpg?hmac=VGy50trdETKDp9Rtt5brwMQ7JYG7S3kZHCvy5slG1Io",
        "otherImage"=>"https://fastly.picsum.photos/id/626/350/350.jpg?hmac=LnDvOPY_RWw3EbQJEIZrg1ZBUdG2UhwhuuzL5oGVr0k"],

        ["id"=> "1234o",
        "category"=>"Pria Golf",
        "subCategory"=> "SHORTS",
        "name"=> "ULTIMATE365 PRINTED",
        "price"=> 1220000,
        "disc"=> 30,
        "image"=> "https://fastly.picsum.photos/id/902/350/350.jpg?hmac=VGy50trdETKDp9Rtt5brwMQ7JYG7S3kZHCvy5slG1Io",
        "otherImage"=>"https://fastly.picsum.photos/id/626/350/350.jpg?hmac=LnDvOPY_RWw3EbQJEIZrg1ZBUdG2UhwhuuzL5oGVr0k"],

        ["id"=> "1234p",
        "category"=>"Pria Golf",
        "subCategory"=> "POLO SHIRT",
        "name"=> "GO-TO PRINTED",
        "price"=> 1160000,
        "disc"=> 30,
        "image"=> "https://fastly.picsum.photos/id/902/350/350.jpg?hmac=VGy50trdETKDp9Rtt5brwMQ7JYG7S3kZHCvy5slG1Io",
        "otherImage"=>"https://fastly.picsum.photos/id/626/350/350.jpg?hmac=LnDvOPY_RWw3EbQJEIZrg1ZBUdG2UhwhuuzL5oGVr0k"],

        ["id"=> "1234q",
        "category"=>"Pria Golf",
        "subCategory"=> "TAS",
        "name"=> "GOLF RINGAN STAND",
        "price"=> 4450000,
        "disc"=> 30,
        "image"=> "https://fastly.picsum.photos/id/902/350/350.jpg?hmac=VGy50trdETKDp9Rtt5brwMQ7JYG7S3kZHCvy5slG1Io",
        "otherImage"=>"https://fastly.picsum.photos/id/626/350/350.jpg?hmac=LnDvOPY_RWw3EbQJEIZrg1ZBUdG2UhwhuuzL5oGVr0k"],

        ["id"=> "1234r",
        "category"=>"Pria Golf",
        "subCategory"=> "SHORTS",
        "name"=> "GO-TO WOVEN",
        "price"=> 1220000,
        "disc"=> 30,
        "image"=> "https://fastly.picsum.photos/id/902/350/350.jpg?hmac=VGy50trdETKDp9Rtt5brwMQ7JYG7S3kZHCvy5slG1Io",
        "otherImage"=>"https://fastly.picsum.photos/id/626/350/350.jpg?hmac=LnDvOPY_RWw3EbQJEIZrg1ZBUdG2UhwhuuzL5oGVr0k"],

        ["id"=> "1234s",
        "category"=>"Wanita Golf",
        "subCategory"=> "SKIRT",
        "name"=> "4-WAY STRETCH",
        "price"=> 1380000,
        "disc"=> 30,
        "image"=> "https://fastly.picsum.photos/id/902/350/350.jpg?hmac=VGy50trdETKDp9Rtt5brwMQ7JYG7S3kZHCvy5slG1Io",
        "otherImage"=>"https://fastly.picsum.photos/id/626/350/350.jpg?hmac=LnDvOPY_RWw3EbQJEIZrg1ZBUdG2UhwhuuzL5oGVr0k"],

        ["id"=> "1234t",
        "category"=>"Pria Golf",
        "subCategory"=> "POLO SHIRT",
        "name"=> "GO-TO NOVELTY",
        "price"=> 812000,
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
        // Validasi data input
        $request->validate([
            'id' => 'required|max:5',
            'name' => 'required|max:50',
            'category' => 'required|max:50',
            'subCategory' => 'required|max:50',
            'price' => 'required|numeric',
            'disc' => 'required|numeric',
            // 'image' => 'nullable|url',
            // 'otherImage' => 'nullable|url',
        ]);

        // Data baru yang akan ditambahkan
        $newProduct = [
            'id' => $request->input('id'),
            'category' => $request->input('category'),
            'subCategory' => $request->input('subCategory'),
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'disc' => $request->input('disc'),
            'image' => $request->input('image', 'https://fastly.picsum.photos/id/902/350/350.jpg?hmac=VGy50trdETKDp9Rtt5brwMQ7JYG7S3kZHCvy5slG1Io'), // Default jika tidak ada
            'otherImage' => $request->input('otherImage', 'https://fastly.picsum.photos/id/626/350/350.jpg?hmac=LnDvOPY_RWw3EbQJEIZrg1ZBUdG2UhwhuuzL5oGVr0k'), // Default jika tidak ada
        ];

        // Tambahkan data baru ke dalam array $products
        array_push($this->products, $newProduct);

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('products.list')->with('success', 'Produk berhasil disimpan!');
    }
    public function show($id)
    {
        // Use array_filter to find the product by id
        $product = collect($this->products)->firstWhere('id', $id);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found!');
        } else {};

        return view('products.show', ['product' => $product]);
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

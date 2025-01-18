<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::getOrdered();

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.form', [
            'title' => 'Add new category'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'order_no' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('image')->store('categories', 'public');

        $category = Category::create([
            'name' => $request->name,
            'order_no' => $request->order_no,
            'image' => 'storage/' . $file
        ]);

        return redirect()->route('categories.list');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::where('id', $id)->firstOrFail();
        return view('categories.form', [
            'title' => 'Edit category',
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string',
            'order_no' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Gambar bersifat opsional
        ]);

        // Temukan kategori berdasarkan ID
        $category = Category::where('id', $id)->firstOrFail();

        // Update data kategori
        $category->name = $request->name;
        $category->order_no = $request->order_no;

        // Cek apakah ada file gambar baru yang diunggah
        if ($request->hasFile('image')) {
            // Hapus file gambar lama jika ada
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            // Simpan file gambar baru
            $file = $request->file('image')->store('categories', 'public');
            $category->image = 'storage/' . $file;
        }

        // Simpan perubahan
        $category->save();

        // Redirect kembali ke daftar kategori
        return redirect()->route('categories.list')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::where('id', $id)->firstOrFail();
        $category->delete();

        return redirect()->route('categories.list');
    }
}

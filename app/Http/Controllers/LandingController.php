<?php

namespace App\Http\Controllers;

use App\Models\CurrentLandingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    function edit()
    {
        return view('landing.edit', ['showFilters' => false]);
    }

    public function store(Request $request)
    {

        // Validasi file
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Ambil file
        $file = $request->file('image');

        // Konversi ke Base64
        $base64Image = base64_encode(file_get_contents($file->path()));

        // Simpan ke database
        CurrentLandingPage::create([
            'image' => $base64Image
        ]);

        return redirect()->route('home');
    }
}

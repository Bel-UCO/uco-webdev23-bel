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
        $file = $request->file('image')->store('landing', 'public');

        // $extension = $request->file('image')->getClientOriginalExtension();
        // $file = $request->file('image')->storeAs('landing', uniqid() . '.' . $extension, 'public');

        // Simpan ke database
        CurrentLandingPage::create([
            'image' => 'storage/' . $file,
        ]);

        return redirect()->route('home');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CurrentLandingPage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        $image = CurrentLandingPage::latest('id')->first();
        // dd($image);

        $categories = Category::get();

        if (!$image) {
            // Tangani jika data tidak ditemukan
            return view('home', [
                'showFilters' => false,
                'image' => null, // Kirim nilai null ke view
                'categories' => $categories
            ]);
        }

        return view('home', [
            'showFilters' => false,
            'image' => $image,
            'categories' => $categories
        ]);
    }
}

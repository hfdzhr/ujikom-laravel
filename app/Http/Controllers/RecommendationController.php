<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Perbaikan: Menggunakan huruf besar pada "App\Models\Product"

class RecommendationController extends Controller
{
    public function recommendProductsForUser()
    {
        $recommendedProducts = Product::inRandomOrder()
            ->limit(5)
            ->get();

        return view('frontend.recommendation', compact('recommendedProducts'));
    }
}

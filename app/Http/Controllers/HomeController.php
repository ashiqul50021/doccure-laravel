<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Speciality;
use App\Models\Doctor;
use App\Models\TopCategory;
use App\Models\SiteSetting;
use App\Models\District;
use App\Models\Product; // For future implementation of product section if needed on home

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $specialities = Speciality::where('is_active', true)->take(10)->get();
        $searchSpecialities = Speciality::where('is_active', true)->get();
        // Fetch doctors who are approved and have an active user account
        $doctors = Doctor::with(['user', 'speciality', 'reviews'])
                         ->where('status', 'approved')
                         ->whereHas('user') // Ensure user exists
                         ->take(10)
                         ->get();

        $productCategories = \App\Models\ProductCategory::where('is_active', true)->take(6)->get();

        // Get top categories
        $topCategories = TopCategory::getActiveCategories();

        // Get banner settings
        $bannerSettings = SiteSetting::getByGroup('banner');

        // Get active banners
        $banners = \App\Models\Banner::active()->ordered()->get();

        // Get all districts for search dropdown
        $districts = District::orderBy('name')->get();

        // Get featured products
        $products = Product::where('is_active', true)
                          ->where('is_featured', true)
                          ->with('category')
                          ->take(8)
                          ->latest()
                          ->get();

        // If no featured products, get latest products
        if ($products->isEmpty()) {
            $products = Product::where('is_active', true)
                              ->with('category')
                              ->take(8)
                              ->latest()
                              ->get();
        }

        // Get active health packages
        $healthPackages = \App\Models\HealthPackage::active()->ordered()->get();

        return view('frontend.home', compact(
            'specialities',
            'searchSpecialities',
            'doctors',
            'productCategories',
            'topCategories',
            'bannerSettings',
            'banners',
            'districts',
            'products',
            'healthPackages'
        ));
    }
}

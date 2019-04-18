<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;
use App\Banner;
use Illuminate\Http\Request;

class PagesController extends Controller {

	// This function will be called to return home page
	public function homePage() {
		// Get product in ascending orders is by default
		$products = Product::where(['status' => 1])->get();

		// Get product in descending order
		$newProducts = Product::where(['status' => 1])->orderBy('id', 'desc')->get();

		// Get product in random order
		$randomProducts = Product::where(['status' => 1])->inRandomOrder()->get();

		$sidebarProducts = Product::where(['status' => 1])->orderBy('id', 'desc')->paginate(2);

		// Get all categories and sub categories
		$categories = Category::with('categories')->where(['parent_id' => 0])->where(['status' => 1])->get();

		// Get all active banners
		$banners = Banner::where('status', 1)->get();

		return view('/index')
			->with(compact('products', 'categories', 'randomProducts', 'newProducts', 'sidebarProducts', 'banners'));
	}
}
<?php

namespace App\Http\Controllers;

use App\Category;
use App\Commons;
use App\Product;
use App\ProductsAttribute;
use App\ProductsImage;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;

class ProductController extends Controller {

	/**
	 * Function to display all products
	 * */
	public function products() {
		if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard.');
		}

		$products = Product::get();

		// Fetch all category names
		foreach ($products as $key => $value) {
			$category = Category::where(['id' => $value->category_id])->first();
			$merchant = User::where(['id' => $value->merchant_id])->first();

			$products[$key]->category_name = $category->name;
			$products[$key]->merchant_name = $merchant->name;
		}

		return view('admin.products.index')->with(compact('products'));
	}

	/**
	 * Function to add new product
	 * */
	public function addProduct(Request $request) {
		if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard.');
		}

		if ($request->isMethod('post')) {
			$req_data = $request->all();
			$product = new Product;
			$product->category_id = $req_data['category_id'];
			$product->product_name = $req_data['product_name'];
			$product->product_color = $req_data['product_color'];
			$product->product_code = $req_data['product_code'];
			$product->description = $req_data['description'];
			$product->product_price = $req_data['product_price'];
			$product->status = $req_data['status'];
			$product->merchant_id = Auth::user()->id;

			// Upload image file
			if ($request->hasFile('product_image')) {
				$tmpImage = Input::file('product_image');

				if ($tmpImage->isValid()) {

					$extension = $tmpImage->getClientOriginalExtension();
					$fileName = rand(111, 99999999) . '.' . $extension;
					$largeImagePath = Commons::LARGE_IMAGE_DIR . $fileName;
					$mediumImagePath = Commons::MEDIUM_IMAGE_DIR . $fileName;
					$smallImagePath = Commons::SMALL_IMAGE_DIR . $fileName;

					// Resize images
					\Image::make($tmpImage)->save($largeImagePath);
					\Image::make($tmpImage)->resize(600, 600)->save($mediumImagePath);
					\Image::make($tmpImage)->resize(300, 300)->save($smallImagePath);

					// Store image name in products table
					$product->product_image = $fileName;
				}
			} else {
				$product->product_image = Commons::PRODUCT_DEFAULT_IMAGE;
			}

			$product->save();
			$message = $req_data['product_name'] . ' added successfully.';

			//return redirect()->back()->with('success_msg', $req_data['product_name'] . ' added successfully.');
			return redirect('/admin/products')->with('success_msg', $message);
		}

		$categories = Category::where(['parent_id' => 0])->get();
		$categoriesDropdown = "<option value='' selected disabled>Select</option>";

		foreach ($categories as $category) {
			$categoriesDropdown .= "<option value='" . $category->id . "'>" . $category->name . "</option>";
			$subCategories = Category::where(['parent_id' => $category->id])->get();

			foreach ($subCategories as $subCat) {
				$categoriesDropdown .= "<option value='" . $subCat->id . "'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $subCat->name . "</option>";
			}
		}

		return view('admin.products.add')->with(compact('categoriesDropdown'));
	}

	/**
	 * Function for editing products
	 * */
	public function editProduct(Request $request, $id = null) {

		if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
		}

		if ($id == null) {
			return redirect('/admin/products/index')->with('error_msg', 'Category not found!');
		} else {
			$id = base64_decode($id);
		}

		if ($request->isMethod('post')) {
			$req_data = $request->all();

			// Upload image file
			if ($request->hasFile('product_image')) {
				$tmpImage = Input::file('product_image');

				if ($tmpImage->isValid()) {

					$extension = $tmpImage->getClientOriginalExtension();
					$fileName = rand(111, 99999999) . '.' . $extension;
					$largeImagePath = Commons::LARGE_IMAGE_DIR . $fileName;
					$mediumImagePath = Commons::MEDIUM_IMAGE_DIR . $fileName;
					$smallImagePath = Commons::SMALL_IMAGE_DIR . $fileName;

					// Resize images
					\Image::make($tmpImage)->save($largeImagePath);
					\Image::make($tmpImage)->resize(600, 600)->save($mediumImagePath);
					\Image::make($tmpImage)->resize(300, 300)->save($smallImagePath);
				}

			} else {
				$fileName = $req_data['current_image'];
			}

			Product::where(['id' => $id])->update([
				'category_id' => $req_data['category_id'],
				'product_name' => $req_data['product_name'],
				'product_color' => $req_data['product_color'],
				'product_price' => $req_data['product_price'],
				'description' => $req_data['description'],
				'product_image' => $fileName,
				'status' => $req_data['status'],
			]);

			return redirect('/admin/products')->with('success_msg', 'Product updated successfully.');
		}

		// Get product details
		$product = Product::where(['id' => $id])->first();

		// Categories dropdown code
		$categories = Category::where(['parent_id' => 0])->get();
		$categoriesDropdown = "<option value='' selected disabled>=== Select ===</option>";
		foreach ($categories as $cat) {

			if ($cat->id == $product->category_id) {
				$selected = "selected";
			} else {
				$selected = "";
			}

			$categoriesDropdown .= "<option value='" . $cat->id . "' " . $selected . ">" . $cat->name . "</option>";
			$subCategories = Category::where(['parent_id' => $cat->id])->get();

			foreach ($subCategories as $subCat) {

				if ($subCat->id == $product->category_id) {
					$selected = "selected";
				} else {
					$selected = "";
				}

				$categoriesDropdown .= "<option value='" . $subCat->id . "' " . $selected . ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $subCat->name . "</option>";
			}
		}
		// Categories dropdown code end here

		return view('admin.products.edit')->with(compact('product', 'categories', 'categoriesDropdown'));
	}

	/**
	 * Function for deleting products
	 * */
	public function deleteProduct($id = null) {
		if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
		}

		if ($id == null) {
			return redirect('/admin/products/index')->with('error_msg', 'Product not found!');
		} else {
			//$id = base64_decode($id);

			$product = Product::where(['id' => $id])->first();

			if ($product->status == 1) {
				$message = $product->product_name . ' was disabled successfully.';
				$status = 0;
			} else {
				$message = $product->product_name . ' was enabled successfully.';
				$status = 1;
			}

			$product = Product::where(['id' => $id])->update([
				'status' => $status,
			]);

			echo $message;die;

			return redirect()->back()->with('success_msg', $message);
		}

		return view('admin.products');
	}

	/**
	 * Function for deleting product image from product image folder
	 * */
	public function deleteImage($id = null) {

		if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
		}

		if ($id == null) {
			return redirect()->back()->with('error_msg', 'Product image not found!');
		}

		$id = base64_decode($id);

		// get the product and collect the product image so we can unset it from the folders
		$product = Product::where(['id' => $id])->first();

		$largeImagePath = Commons::LARGE_IMAGE_DIR . $product->product_image;
		$mediumImagePath = Commons::MEDIUM_IMAGE_DIR . $product->product_image;
		$smallImagePath = Commons::SMALL_IMAGE_DIR . $product->product_image;

		// Remove Large Image if exist in folder
		if (file_exists($largeImagePath)) {
			unlink($largeImagePath);
		}

		// Remove Medium Image if exist in folder
		if (file_exists($mediumImagePath)) {
			unlink($mediumImagePath);
		}

		// Remove Small Image if exist in folder
		if (file_exists($smallImagePath)) {
			unlink($smallImagePath);
		}

		Product::where(['id' => $id])->update(['product_image' => Commons::PRODUCT_DEFAULT_IMAGE]);

		return redirect('/admin/products/edit/' . base64_encode($product->id))
			->with('success_msg', 'The image for ' . $product->product_name . ' deleted successfully!');
	}


	public function deleteAlternateImage($id = null) {

		if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard.');
		}

		if ($id == null) {
			return redirect()->back()->with('error_msg', 'Product image not found!');
		}

		$id = base64_decode($id);

		// get the product and collect the product image so we can unset it from the folders
		$productImage = ProductsImage::where(['id' => $id])->first();

		$largeImagePath = Commons::LARGE_IMAGE_DIR . $productImage->product_image;
		$mediumImagePath = Commons::MEDIUM_IMAGE_DIR . $productImage->product_image;
		$smallImagePath = Commons::SMALL_IMAGE_DIR . $productImage->product_image;

		// Remove Large Image if exist in folder
		if (file_exists($largeImagePath)) {
			unlink($largeImagePath);
		}

		// Remove Medium Image if exist in folder
		if (file_exists($mediumImagePath)) {
			unlink($mediumImagePath);
		}

		// Remove Small Image if exist in folder
		if (file_exists($smallImagePath)) {
			unlink($smallImagePath);
		}

		ProductsImage::where(['id' => $id])->delete();

		return redirect()->back()->with('success_msg', 'Product alternate image has been deleted successfully!');
	}

	/**
	 * This functions will be called to show all products
	 */
	public function getProducts($url = null) {
		// Show 404 page when Category URL does not exist
		$categoryCount = Category::where(['url' => $url])->where(['status' => 1])->count();
		if ($categoryCount < 1) {
			abort(404);
		}

		// Get all categories and sub categories
		$categories = Category::with('categories')->where(['parent_id' => 0])->where(['status' => 1])->get();

		$category = Category::where(['url' => $url])->where(['status' => 1])->first();

		$sidebarProducts = Product::where('category_id', '!=', $category->id)
			->where(['status' => 1])->orderBy('id', 'desc')->paginate(2);

		if ($category->parent_id == 0) {
			# Url is main category url
			$subCategories = Category::where(['parent_id' => $category->id])->where(['status' => 1])->get();
			$seperator = ',';
			$cat_ids = $category->id . $seperator;

			foreach ($subCategories as $key => $subCat) {
				$cat_ids .= $subCat->id . $seperator;
			}

			$cat_ids = explode(",", $cat_ids);

			$products = Product::whereIn('category_id', $cat_ids)->where(['status' => 1])->get();

			// echo "<pre>IF >>>>>>>>";
			// print_r($cat_ids);die;

		} else {
			# Url is sub category url
			$products = Product::where(['category_id' => $category->id])->where(['status' => 1])->get();
			// echo "<pre>ELSE >>>>>>>>";
			// print_r($products);die;
		}

		return view('front.products')->with(compact('categories', 'category', 'products', 'sidebarProducts'));
	}

	/**
	 * This functions will be called to get a single product
	 */
	public function getProduct($id = null) {

		if ($id == null) {
			abort(404);
		} else {
			$id = base64_decode($id);
		}

		$productCount = Product::where('id', $id)->where('status', 1)->count();
		if ($productCount < 1) {
			abort(404);
		}

		// Get category and sub category details
		$categories = Category::with('categories')->where(['parent_id' => 0])->where(['status' => 1])->get();

		// Get product details
		$product = Product::with('attributes')->where('id', $id)->where('status', 1)->first();
		//echo "<pre>";print_r($product);die;

		$sidebarProducts = Product::where('id', '!=', $id)
			->where(['id' => $id, 'status' => 1])->orderBy('id', 'desc')->paginate(2);

		// Get product images
		$productImages = ProductsImage::where('product_id', $id)->get();

		$relatedProducts = Product::where('id', '!=', $id)
			->where(['category_id' => $product->category_id, 'status' => 1])->inRandomOrder()->paginate(3);

		//$totalStock = ProductsAttribute::where('product_id', $id)->sum('stock');
		$totalStock = Product::select('stock')->where('id', $id)->first();

		return view('front.product')
			->with(compact('categories', 'product', 'relatedProducts', 'productImages', 'totalStock', 'sidebarProducts'));
	}

	/**
	 * <================= PRODUCT ATTRIBUTES METHODS ====================>
	 * */

	/**
	 * This function will be called to add attributes to products
	 * */
	public function addAttributes(Request $request, $id = null) {

		if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
		}

		if ($id == null) {
			return redirect()->back()->with('error_msg', 'No product found for the request sent!');
		} else {
			$id = base64_decode($id);
		}

		$product = Product::with('images')->where(['id' => $id])->first();
		$sent = false;

		if ($request->isMethod('post')) {
			$req_data = $request->all();

			foreach ($req_data['size'] as $key => $value) {
				if (!empty($value)) {
					// generate the poduct sku
					$sku = $req_data['size'][$key] . $req_data['weight'][$key] . rand(111, 99999999) . '-' . Auth::user()->id;
					// Duplicate SKU checks
					$attributeCount = ProductsAttribute::where('product_sku', $sku)->count();
					if ($attributeCount > 0) {
						return redirect('admin/products/add-attributes/' . base64_encode($id))
							->with('error_msg', $req_data['sku'][$key] . ' attributes already exists!');
					}

					$attributeCount = ProductsAttribute::where('product_id', $id)->where('size', $req_data['size'][$key])->count();
					if ($attributeCount > 0) {
						return redirect('admin/products/add-attributes/' . base64_encode($id))
							->with('error_msg', $req_data['size'][$key] . ' product attributes already exists for this product!');
					}

					$attribute = new ProductsAttribute;
					$attribute->product_id = $id;
					$attribute->product_sku = $sku;
					$attribute->product_color = $req_data['color'][$key];
					$attribute->size = $req_data['size'][$key];
					$attribute->price = $req_data['price'][$key];
					$attribute->stock = $req_data['stock'][$key];
					$attribute->weight = $req_data['weight'][$key];
					$attribute->merchant_id = Auth::user()->id;

					// save
					$attribute->save();
					$sent = true;
				}
			}

			$success_msg = 'Product attributes successfully added for ' . $product->product_name;
			$error_msg = 'There was an error updating product attributes for ' . $product->product_name;
			$id = base64_encode($id);

			if ($sent) {
				return redirect('/admin/products/add-attributes/' . $id)->with('success_msg', $success_msg);
			} else {
				return redirect('/admin/products/add-attributes/' . $id)->with('error_msg', $error_msg);
			}
		}

		return view('admin.products.add_attributes')->with(compact('product'));
	}


	/**
	 *
	 * edit attributes
	 *
	 * @param    $request, id
	 * @return   $attributes
	 *
	 */
	public function editAttributes(Request $request) {
		
		if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
		}

		if ($id == null) {
			return redirect()->back()->with('error_msg', 'No product found for the request sent!');
		} else {
			//$id = base64_decode($id);
		}

		if ($request->isMethod('post')) {
			$req_data = $request->all();
			//echo "<pre>"; print_r($req_data);die;

			foreach ($req_data['id'] as $key => $editId) {
				ProductsAttribute::where(['id' => $req_data['id'][$key]])->update(
					['price' => $req_data['price'][$key], 'stock' => $req_data['stock'][$key]]
				);
			}

			return redirect()->back()->with('success_msg', 'Products Attributess has been updated successfully!');
		}

		return redirect()->back()->with('success_msg', 'Products Attributess has been updated successfully!');
	}


	public function editAttributesJS(Request $request, $id=null, $qty=null, $price=null) {
		
		if (!Session::has('adminSession')) {
			echo "Please login first!";die;
			//return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
		}

		// ProductsAttribute::where(['id' => $id])->update(
		// 	['price' => $price, 'stock' => $stock]
		// );
		$pa = ProductsAttribute::where('id', $id)->first();
		$pa->stock = $qty;
		$pa->price = $price;

		if ($pa->save()) {
			echo "Products Attributes has been updated successfully!";die;
		}

		echo "There was an error updating the product attributes!";die;
	}


	/**
	 *
	 * deleting product attributes
	 *
	 * @param    object  $id
	 * @return   null
	 *
	 */
	public function deleteAttribute($id = null) {
		if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
		}

		if ($id == null) {
			return redirect()->back()->with('error_msg', 'Product not found!');
		} else {
			//$id = base64_decode($id);
			$attribute = ProductsAttribute::where(['id' => $id])->first();

			if ($attribute->status == 1) {
				$message = 'Attribute was disabled successfully.';
				$status = 0;
			} else {
				$message = 'Attribute was enabled successfully.';
				$status = 1;
			}

			ProductsAttribute::where(['id' => $id])->update([
				'status' => $status,
			]);

			return redirect()->back()->with('success_msg', $message);
		}
	}

	/**
	 *
	 * getting all products attributes
	 *
	 * @param    object  $request
	 * @return   $attributes
	 *
	 */
	public function getProductAttribute(Request $request) {
		$req_data = $request->all();
		//echo "<pre>"; print_r($req_data);die;
		$pro_array = explode("-", $req_data['ptSize']);
		$attribute = ProductsAttribute::where(['product_id' => $pro_array[0], 'size' => $pro_array[1]])->first();

		$attribute = json_encode($attribute);
		return ($attribute);
	}

	/**
	 *
	 * adding image or multiple image to products_images table
	 *
	 * @param    object  $image
	 * @return   null
	 *
	 */
	public function addImages(Request $request, $id = null) {
		if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
		}

		if ($id == null) {
			return redirect()->back()->with('error_msg', 'No product selected for this request!');
		} else {
			$id = base64_decode($id);
		}

		$product = Product::with('attributes')->where(['id' => $id])->first();
		$sent = false;

		if ($request->isMethod('post')) {
			$req_data = $request->all();
			// add images
			if ($request->hasFile('product_image')) {
				$files = $request->file('product_image');
				//echo "<pre>";print_r($files);die;

				// iterate through all images
				foreach ($files as $tmpImage) {
					$extension = $tmpImage->getClientOriginalExtension();
					$fileName = rand(111, 99999999) . '.' . $extension;
					$largeImagePath = Commons::LARGE_IMAGE_DIR . $fileName;
					$mediumImagePath = Commons::MEDIUM_IMAGE_DIR . $fileName;
					$smallImagePath = Commons::SMALL_IMAGE_DIR . $fileName;

					// Resize images
					\Image::make($tmpImage)->save($largeImagePath);
					\Image::make($tmpImage)->resize(600, 600)->save($mediumImagePath);
					\Image::make($tmpImage)->resize(300, 300)->save($smallImagePath);

					// upload image
					$image = new ProductsImage;
					$image->product_image = $fileName;
					$image->product_id = $id;
					$image->merchant_id = Auth::user()->id;
					$image->status = 1;
					$image->save();
					$sent = true;
				}

				$success_msg = 'Product images successfully added for ' . $product->product_name;
				$error_msg = 'There was an error adding image for ' . $product->product_name;
				$id = base64_encode($id);

				if ($sent) {
					return redirect('/admin/products/add-images/' . $id)->with('success_msg', $success_msg);
				} else {
					return redirect('/admin/products/add-images/' . $id)->with('error_msg', $error_msg);
				}
			}
		}

		return view('admin.products.add_images')->with(compact('product'));
	}
}

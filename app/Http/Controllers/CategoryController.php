<?php

namespace App\Http\Controllers;

use App\Category;
use Auth;
use Illuminate\Http\Request;
use Session;
use App\Coupon;

class CategoryController extends Controller {

	/**
	 * Function to display all categories
	 * */
	public function categories(Request $request, $id = null) {
		if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
		}

		$categories = Category::get();
		$subCategory = Category::where(['parent_id' => 0, 'status' => 1])->get();

		return view('admin.categories.index')->with(compact('categories', 'subCategory'));
		//return view('admin.categories.index');
	}

	/**
	 * This function is used to load categories table to the category page
	 * */
	public function loadCategoryTable() {
		if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
		}

		$categories = Category::where(['status' => 1])->get();

		return view('admin.categories.loadCategoryTable')->with(compact('categories'));
	}

	/**
	 * Function for adding new categories
	 * */
	public function addCategory(Request $request) {
		//die('Test');
		if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
		}

		if ($request->isMethod('post')) {
			$req_data = $request->all();
			//echo "<pre>"; print_r($req_data);die;
			$category = new Category;
			$category->name = $req_data['name'];
			$category->parent_id = $req_data['parent_id'];
			$category->description = $req_data['description'];
			$category->url = $req_data['url'];
			$category->status = $req_data['status'];
			$category->created_by = Auth::user()->id;
			$category->save();

			$message = $req_data['name'] . ' category added successfully.';

			return redirect('/admin/categories')->with('success_msg', $message);
		}

		$subCategory = Category::where(['parent_id' => 0, 'status' => 1])->get();

		return view('admin.categories.add')->with(compact('subCategory'));
	}

	/**
	 * Function for editing categories
	 * */
	public function editCategoryPost(Request $request, $id = null) {

		if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
		}

		if ($id == null) {
			return redirect('/admin/categories/index')->with('error_msg', 'Category not found!');
		} else {
			$id = base64_decode($id);
		}

		if ($request->isMethod('post')) {
			$req_data = $request->all();

			Category::where(['id' => $id])->update([
				'name' => $req_data['name'],
				'parent_id' => $req_data['parent_id'],
				'description' => $req_data['description'],
				'url' => $req_data['url'],
				'status' => $req_data['status']
			]);

			$message = $req_data['name'] . ' category updated successfully.';

			return redirect('/admin/categories')->with('success_msg', $message);
		}

		$category = Category::where(['id' => $id])->first();
		$subCategory = Category::where(['parent_id' => 0, 'status' => 1])->get();

		return view('admin.categories.edit')->with(compact('category', 'subCategory'));
	}

	/**
	 * Function for editing categories
	 * */
	public function editCategory($id, $pid, $name, $desc, $url) {

		if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
		}

		if ($id == null) {
			return redirect('/admin/categories/index')->with('error_msg', 'Category not found!');
		} else {
			//$id = base64_decode($id);
		}

		$category = Category::where('id', $id)->first();

        if (!empty($category)) {
            $category->name = $name;
            $category->parent_id = $pid;
            $category->description = $desc;
            $category->url = $url;
            $category->save();
            
            echo $name . ' category updated successfully.';die;

        } else {
            echo 'There was an error updating the category!';die;
        }
	}

	/**
	 * Function for deleting categories
	 * */
	public function deleteCategory($id = null) {
		if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
		}

		if ($id == null) {
			return redirect('/admin/categories/index')->with('error_msg', 'Category not found!');
		} else {
			//$id = base64_decode($id);

			$category = Category::where(['id' => $id])->first();

			if ($category->status == 1) {
				$message = $category->name . ' category disabled successfully.';
				$status = 0;
			} else {
				$message = $category->name . ' category enabled successfully.';
				$status = 1;
			}

			$category = Category::where(['id' => $id])->update([
				'status' => $status,
			]);

			echo $message;die;
			//return redirect()->back()->with('success_msg', $message);
		}

		return view('admin.categories');
	}


	/**
	 * Apply Coupon
	 */
	public function applyCoupon() {
		
	}

}

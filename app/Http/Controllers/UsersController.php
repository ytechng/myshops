<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\User;

class UsersController extends Controller
{
    /**
     * function to display banners
     */
    public function registerOrLogin(Request $request)
    {
        // Get all categories and sub categories
        $categories = Category::with('categories')->where(['parent_id' => 0])->where(['status' => 1])->get();

        $category = Category::where(['status' => 1])->first();

        $sidebarProducts = Product::where('category_id', '!=', $category->id)
            ->where(['status' => 1])->orderBy('id', 'desc')->paginate(2);

        if ($request->isMethod('post')) {
            $req_data = $request->all();

            $userCount = User::where('email', $req_data['r_email'])->count();

            if ($userCount > 0) {
                return redirect()->back()->with('error_msg', 'Email already exits!')
                    ->with(compact('Category', 'categories', 'sidebarProducts'));
            } else {
                echo "Success";die;
            }
            
        }
        
        return view('users.login_register')->with(compact('Category', 'categories', 'sidebarProducts'));
    }

    /**
     * function checkEmail
     * check to see if user email already exists in the database
     */
    function checkEmail(Request $request) {
        $req_data = $request->all();
        $userCount = User::where('email', $req_data['r_email'])->count();

        if ($userCount > 0) {
            echo "false";die;
        } else {
            echo "true";die;
        }
    }
}

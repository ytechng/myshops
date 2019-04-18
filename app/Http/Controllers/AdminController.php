<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

class AdminController extends Controller {

	public function login(Request $request) {

		if ($request->isMethod('post')) {
			$login_data = $request->input();

			if (Auth::attempt(['email' => $login_data['email'], 'password' => $login_data['password'], 'admin' => '1'])) {
				//echo 'Success.....';die;
				Session::put('adminSession', $login_data['email']);
				return redirect('/admin/dashboard');

			} else {
				//echo 'Failed......';die;
				return redirect('/admin')->with('error_msg', 'Invalid Username or Password!');
			}
		}

		return view('admin.admin_login');
	}

	public function dashboard() {
		if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
		}

		return view('/admin/dashboard');
	}

	public function setting() {
		if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
		}

		return view('/admin/setting');
	}

	public function checkPassword(Request $request) {
		$req_data = $request->all();
		$cur_password = $req_data['cur_password'];

		$check_password = User::where(['admin' => '1'])->first();

		if (Hash::check($cur_password, $check_password->password)) {
			die('true');
		} else {
			die('false');
		}
	}

	public function updatePassword(Request $request) {
		if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
		}

		if ($request->isMethod('post')) {
			$req_data = $request->all();
			//echo "<pre>";print_r($req_data);die;
			//var_dump(Auth::user());die;
			$check_password = User::where(['email' => Auth::user()->email])->first();
			$cur_password = $req_data['cur_password'];

			if (Hash::check($cur_password, $check_password->password)) {
				$password = bcrypt($req_data['new_password']);
				User::where('email', Auth::user()->email)->update(['password' => $password]);

				return redirect('/admin/setting')->with('success_msg', 'Password modification successful.');
			} else {
				return redirect('/admin/setting')->with('error_msg', 'Password modification failed.');
			}
		}

		return view('/admin/setting');
	}

	public function logout() {
		Session::flush();
		return redirect('/admin')->with('success_msg', 'Logged Out Successfully!');
	}

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class SessionCheck extends Model {
	public function isAdmin() {
		if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
		}
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Coupon;
use Session;
use App\User;

class CouponsController extends Controller {

    public function coupons() {
        if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard.');
        }
        
        $coupons = Coupon::get();

        foreach ($coupons as $key => $value) { 
			$merchant = User::where(['id' => $value->createdBy])->first();
			$coupons[$key]->merchant_name = $merchant->name;
		}

        return view('admin.coupons.index')->with(compact('coupons'));
    }

    /**
	 *
	 * Add Coupon
	 *
	 * @param    object $request
	 * @return   $message
	 *
	 */
    public function addCoupon(Request $request) {
        if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard.');
        }
        
        if ($request->isMethod('post')) {
            $req_data = $request->all();
            
            $coupon = new Coupon;
            $coupon->coupon_code = $req_data['coupon_code'];
            $coupon->amount = $req_data['amount'];
            $coupon->amount_type = $req_data['amount_type']; // 1 = percentage and 2 = fixed rate
            $coupon->start_date = $req_data['start_date'];
            $coupon->expiry_date = $req_data['expiry_date'];
            $coupon->status = $req_data['status'];
            $coupon->createdBy = Auth::user()->id;
            $coupon->save();

            return redirect()->back()->with('success_msg', 'Coupon code added successfully!');
        }

        return view('admin.coupons.add');
    }

    /**
	 *
	 * Editing Coupons
	 *
	 * @param    $code, $amount, $type, $edate
	 * @return   $message
	 *
	 */
    public function editCoupon($code, $amount, $type, $sdate, $edate) {
        if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard.');
        }

        $coupon = Coupon::where('coupon_code', $code)->first();

        if (!empty($coupon) && ($sdate <= $edate)) {
            $coupon->amount = $amount;
            $coupon->amount_type = $type;
            $coupon->start_date = $sdate;
            $coupon->expiry_date = $edate;
            $coupon->save();
            
            echo 'Coupon updated successfully!';die;

        } else {
            echo 'There was an error updating this coupon!';die;
        }
    }

    /**
	 *
	 * Editing Coupons
	 *
	 * @param    $code, $amount, $type, $edate
	 * @return   $message
	 *
	 */
    public function deleteCoupon($code = null) {
        if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard.');
        }
        //print_r($code);die;
        $coupon = Coupon::where('coupon_code', $code)->first();

        if ($coupon->status == 1) {
            $message = 'Coupon DISABLED successfully!';
            $status = 0;
        } else {
            $message = 'Coupon ENABLED successfully.';
            $status = 1;
        }

        $coupon->status = $status;
        $coupon->save();

        echo $message;die;
    }
}
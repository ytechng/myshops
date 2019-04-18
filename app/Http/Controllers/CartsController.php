<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Coupon;
use App\CouponType;
use App\Product;
use DB;
use Illuminate\Http\Request;
use Session;

class CartsController extends Controller
{
    /**
     * function to add to cart
     */
    public function addToCart(Request $request)
    {
				// Forget Coupon Code and Amount in Session
				Session::forget('coupon_code');
				Session::forget('coupon_amount');

        $req_data = $request->all();
        //echo "<pre>"; print_r($req_data);die;

        if (empty($req_data['cust_email'])) {
            $req_data['cust_email'] = '';
        }

        // get session_id
        $session_id = Session::get('session_id');

        if (empty($session_id)) {
            // generate session
            $session_id = str_random(40);
            // set the session
            Session::put('session_id', $session_id);
        }

        // check product quantity
        $getProductQty = Product::select('stock')->where('id', $req_data['product_id'])->first();

        if ($getProductQty->stock < $req_data['quantity']) {
            return redirect()->back()->with('error_msg', 'Low stock error!');
        }

        $cartProduct = Cart::where([
            'session_id' => $session_id,
            'price' => $req_data['price'],
            'size' => $req_data['size'],
            'merchant_id' => $req_data['merchant_id'],
        ])->first();

        if (count($cartProduct) > 0) {
            $cartProduct->quantity = ($cartProduct->quantity + $req_data['quantity']);
            $cartProduct->save();

            return redirect('cart')->with('success_msg', 'Product has been updated in the Cart!');

        } else {

            DB::Table('carts')->insert([
                'product_id' => $req_data['product_id'],
                'product_name' => $req_data['product_name'],
                'product_sku' => $req_data['product_sku'],
                'product_color' => $req_data['product_color'],
                'quantity' => $req_data['quantity'],
                'price' => $req_data['price'],
                'size' => $req_data['size'],
                'merchant_id' => $req_data['merchant_id'],
                'cust_email' => $req_data['cust_email'],
                'session_id' => $session_id,
            ]);

        }

        return redirect('cart')->with('success_msg', 'Product has been added in the Cart!');
    }

    /**
     * function to display cart items
     */
    public function cart()
    {
        // Get all categories and sub categories
        $categories = Category::with('categories')->where(['parent_id' => 0])->where(['status' => 1])->get();

        $category = Category::where(['status' => 1])->first();

        $sidebarProducts = Product::where('category_id', '!=', $category->id)
            ->where(['status' => 1])->orderBy('id', 'desc')->paginate(2);

        $session_id = Session::get('session_id');
        $userCart = DB::Table('carts')->where(['session_id' => $session_id])->get();

        foreach ($userCart as $key => $prd) {
            $product = Product::where('id', $prd->product_id)->first();
            $userCart[$key]->product_image = $product->product_image;
        }
        //echo "<pre>"; print_r($userCart);die;

        return view('front.cart')->with(compact('categories', 'category', 'sidebarProducts', 'userCart'));
    }

    /**
     * function to remove cart
     */
    public function removeCart($id = null)
    {
				// Forget Coupon Code and Amount in Session
				//session_start();
				Session::forget('coupon_code');
				Session::forget('coupon_amount');

        DB::table('carts')->where('id', $id)->delete();
        //Cart::where(['id' => $id])->delete();

        echo "Cart deleted";die;

        //return redirect('cart')->with('success_msg', 'Product was successfully removed from cart!');
    }

    /**
     * function to update cart items quantity
     */
    public function updateCart($id = null, $qty = null)
    {
				// Forget Coupon Code and Amount in Session
				//session_start();
				Session::forget('coupon_codet');
				Session::forget('coupon_amount');

        if ($id == null || $qty == null) {
            echo "There was an error updating the cart!";die;
        }

        $cart = Cart::where('id', $id)->first();
        $product = Product::select('stock')->where('product_sku', $cart->product_sku)->first();

        if (count($product) < 1) {
            $product = ProductAttributes::select('stock')->where('product_sku', $cart->product_sku)->first();
        }

        if ($product->stock >= $qty) {
            //print_r($cart);die;
            $cart->quantity = $qty;
            $cart->save();

            echo "Success";die;
        } else {
            echo "Error";die;
        }
        //get the product and confirm quantity available
    }

    /**
     * function for applying coupon
     */
    public function applyCoupon(Request $request)
    {
				// Forget Coupon Code and Amount in Session
				Session::forget('coupon_code');
				Session::forget('coupon_amount');

				$req_data = $request->all();

        if (isset($_POST['apply_coupon'])) { // check if apply coupon button is clicked
            $couponCount = Coupon::where('coupon_code', $req_data['coupon_code'])->count();

            // first check if coupon code is invalid
            if ($couponCount == 0) {
                return redirect()->back()->with('error_msg', 'Invalid coupon code!');
            } else {
                // if coupon code is valid
                // then perform other checks like active/inactive, enable/disable, expiry date

                // get coupon data from the database
                $coupon = Coupon::where('coupon_code', $req_data['coupon_code'])->first();

                // checking if coupon code is inactive
                $currentDate = date('Y-m-d');
                //echo $currentDate . ' = ' . $coupon->start_date;die;
                if ($coupon->status == 0) {
                    return redirect()->back()->with('error_msg', 'This Coupon code is not active!');
                }

                // checking if coupon code start_date less than current date
                if ($currentDate < $coupon->start_date) {
                    return redirect()->back()->with('error_msg', 'This Coupon code is not active!');
                }

                // checking if coupon code is expired
                if ($currentDate > $coupon->expiry_date) {
                    return redirect()->back()->with('error_msg', 'This Coupon code has expired!');
                }

                // Coupon Code is VALID for discount
                // Get Cart TotalAmount
                $session_id = Session::get('session_id');
                $userCart = DB::table('carts')->where(['session_id' => $session_id])->get();
                $totalAmount = 0;

                foreach ($userCart as $item) {
                    $totalAmount += $item->quantity * $item->price;
                }

                // checking if coupon amount type if fixed or percentage
                if ($coupon->amount_type == CouponType::PERCENTAGE) {
                    $couponAmount = $totalAmount * ($coupon->amount / 100);

                } else if ($coupon->amount_type == CouponType::FIXED_RATE) {
                    $couponAmount = $coupon->amount;
				}

                // Add Coupon Code and Amount in Session
                Session::put('coupon_amount', $req_data['coupon_code']);
                Session::put('coupon_amount', $couponAmount);
                
                return redirect()->back()->with('success_msg', 'Coupon code successfully applied. You are availing discount!');
            }
        }

        return redirect()->back()->with('error_msg', 'Error');
    }
}

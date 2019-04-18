<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Banner;
use App\Commons;
use Session;
use Auth;

class BannersController extends Controller
{
    /**
     * function to display banners
     */
    public function banners()
    {
        if (!Session::has('adminSession')) {
            return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
        }

        $banners = Banner::get();

        return view('admin.banners.index')->with(compact('banners'));
    }

    /**
     * function to add to banner
     */
    public function addBanner(Request $request)
    {
        if (!Session::has('adminSession')) {
            return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
        }

        if ($request->isMethod('post')) {
            $req_data = $request->all();

            $banner = new Banner;
            $banner->title = $req_data['title'];
            $banner->description = $req_data['description'];
            $banner->link = $req_data['link'];
            $banner->link_to_website = $req_data['linkto'];
            $banner->description = $req_data['description'];
            $banner->status = $req_data['status'];
            $banner->creator = Auth::user()->id;

            // Upload image file
            if ($request->hasFile('image')) {
                $tmpImage = Input::file('image');

                if ($tmpImage->isValid()) {

                    $extension = $tmpImage->getClientOriginalExtension();
                    $fileName = rand(111, 99999999) . '.' . $extension;
                    $imagePath = Commons::BANNER_IMAGE_DIR . $fileName;

                    // Resize images
                    //\Image::make($tmpImage)->resize(1170, 480)->save($imagePath);
                    \Image::make($tmpImage)->resize(1170, 340)->save($imagePath);

                    // Store image name in banners table
                    $banner->image = $fileName;
                }
            } 

            $banner->save();
            $message = 'New banner added successfully.';

            return redirect()->back()->with('success_msg', $message);
            //return redirect('/admin/banners')->with('success_msg', $message);
        }

        return view('admin.banners.add');
    }

    /**
     * function to display banners
     */
    public function editBanner(Request $request)
    {
        if (!Session::has('adminSession')) {
            return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
        }

        if ($request->isMethod('post')) {
            $req_data = $request->all();
            $id = $req_data['id'];

            $banner = Banner::select('image')->where('id', $id)->first();

            if (empty($req_data['link'])) {
                $req_data['link'] = '#';
            }

            if (empty($req_data['description'])) {
                $req_data['description'] = '';
            }

			// Upload image file
			if ($request->hasFile('image')) {
				$tmpImage = Input::file('image');

				if ($tmpImage->isValid()) {

                    // Remove banner image if exist in folder  
                    $imagePath = Commons::BANNER_IMAGE_DIR . $banner->image;
                    //echo 'OLD' . $imagePath;
                    
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }

					$extension = $tmpImage->getClientOriginalExtension();
					$fileName = rand(111, 99999999) . '.' . $extension;
                    $imagePath = Commons::BANNER_IMAGE_DIR . $fileName;
                    //echo 'NEW' . $imagePath;die;
					// Resize images
                    \Image::make($tmpImage)->resize(1170, 340)->save($imagePath);
				}

			} else {
				$fileName = $banner->image;
			}

			Banner::where(['id' => $id])->update([
				'title' => $req_data['title'],
				'link' => $req_data['link'],
                'link_to_website' => $req_data['linkto'],
                'description' => $req_data['description'],                
				'image' => $fileName
			]);

			return redirect('/admin/banners')->with('success_msg', 'Banner updated successfully.');
		}

        //$banner = Banner::where('id', $id)->first();
    }


    /**
	 * Function for deleting categories
	 * */
	public function deleteBanner($id = null) {
		if (!Session::has('adminSession')) {
			return redirect('/admin')->with('error_msg', 'Please login to access the dashboard');
		}

		if ($id == null) {
			return redirect('/admin/banners/index')->with('error_msg', 'Banner not found!');
		} else {
			//$id = base64_decode($id);

			$banner = Banner::where(['id' => $id])->first();

			if ($banner->status == 1) {
				$message = $banner->title . ' banner disabled successfully.';
				$status = 0;
			} else {
				$message = $banner->title . ' banner enabled successfully.';
				$status = 1;
			}

			$category = Banner::where(['id' => $id])->update([
				'status' => $status,
			]);

			echo $message;die;
			//return redirect()->back()->with('success_msg', $message);
		}

		return view('admin.banners');
	}

}

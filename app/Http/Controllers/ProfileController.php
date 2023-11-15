<?php

namespace App\Http\Controllers;
use App\Models\Designation;
use App\Models\Image;
use App\Models\Profile;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $designation = Designation::all(); // get all designation 

        $user = User::find(Auth::user()->id);

        

        $profile = $user->profile;

        if ($profile) {
            $design = $profile->designation;

  
            $image = $user->image;

            // dd($image->img_name);


            return view('user-profile', compact('user', 'profile', 'design', 'designation','image'));
        } else {
            return view('user-profile', compact('user', 'profile', 'designation'));
        }
    }

    public function storeProfile(Request $request, $id)
    {

        $user = User::find(Auth::user()->id);  // get the id user
       
        // $validation = $request->validate([
        //     'designation' =>'required',
        //     'nric' => 'required',
        //     'phone' => 'required',
        //     'address' => 'required'
        //    ]);
        if ($request->hasFile('user-image')) {
            $image = $request->file('user-image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imageType = $image->getClientOriginalExtension();
            $image->storeAs('public/user_images', $imageName); // Store the image in 'storage/app/public/school_images'
            $pathimage = 'user_images/' . $imageName;
        }
        
        //check this user already has profile or not 

        $profile = $user->profile; //get the value of profile for selected id user user->proefile
        if($profile) 
        {
            $image = $user->image;
            if($image)
            {
                $oldImagePath = $image->img_name; 
                $oldImageType = $image->img_type;

                if (Storage::exists('public/'. $oldImagePath) && $request->hasFile('user-image') ) 
                {
                    Storage::delete('public/'.$oldImagePath);
                }
            }
            // get the current path if profile is exists

        }

        //check either input type file has file / not
        if ($request->hasFile('user-image')) {
            $create1 = Image::updateOrCreate(
                [
                    'user_id' => $id,
                ],
                [
                    'img_name' => $pathimage, // insert the new path 
                    'img_type' => $imageType,
                ],
            );
        }
        else{
            $create1 = Image::updateOrCreate(
                [
                    'user_id' => $id,
                ],
                [
                    'img_name' => $oldImagePath, // insert the new path 
                    'img_type' => $oldImageType,
                ],
            );
        }

        
        // dd($pathimage);
    
        if (!$create1) {
            return redirect()
                ->back()
                ->with('Error', 'Update image unsuccesfully');
        }
        
        $create = Profile::updateOrCreate(
            [
                'user_id' => $id,
            ],
            [
                'userimage_id' => $create1->id,
                'designation_id' => $request->designation,
                'nric_no' => $request->nric,
                'phone_no' => $request->phone,
                'address' => $request->address,
            ],
        );

        $create2 = User::updateOrCreate(
            [
                'id' => $id,
            ],
            [
                'name' => $request->fullName,
                'email' =>$request->email
            ]
        );

        if (!$create || !$create2) {
            return redirect()
                ->back()
                ->with('Error', 'Update profile unsuccesfully');
        }
        return redirect()->route('user');
    }

    
}

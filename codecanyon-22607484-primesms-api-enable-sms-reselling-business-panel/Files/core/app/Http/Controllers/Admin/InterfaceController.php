<?php

namespace App\Http\Controllers\Admin;

use App\GeneralSetting;
use App\Slider;
use App\Social;
use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InterfaceController extends Controller
{
   public function logoIconUpdate(Request $request){
       if ($request->hasFile('logo')) {
           @unlink("assets/user/upload/logo/logo.png");
           Image::make($request->file('logo')->getRealPath())->save("assets/user/upload/logo/logo.png");
       }
       if ($request->hasFile('icon')) {
           @unlink("assets/user/upload/logo/icon.png");
           Image::make($request->file('icon')->getRealPath())->resize(60, 60)->save("assets/user/upload/logo/icon.png");
       }
       session()->flash('success', 'Logo and Icon updated successfully');
       return back();
   }

   public function contact(){
       $item = GeneralSetting::first();
       return view('admin.interface.contact', compact('item'));
   }

   public function contactStore(Request $request){
       $item = GeneralSetting::first();
       $item->contact_address = $request->contact_address;
       $item->contact_phone = $request->contact_phone;
       $item->contact_email = $request->contact_email;
       $item->save();
       session()->flash('success', 'Contact information updated successfully');
       return back();
   }
}

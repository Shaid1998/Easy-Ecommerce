<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type'=> 'success'
        );

        return redirect('/login')->with($notification);
    } //End Method

    public function profile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view',compact('adminData'));


    }//End Method
    public function EditProfile(){
        $id = Auth::user()->id;
        $EditData = User::find($id);
        return view('admin.admin_profile_edit',compact('EditData'));


    }//End Method
    public function StoreProfile(Request $request){
        $id = Auth::user()->id;
        $Data = User::find($id);
        $Data->name = $request->name;
        $Data->email = $request->email;
        $Data->username = $request->username;
        
        if($request->file('profile_image')){
            $file = $request->file('profile_image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploaded/admin'), $filename);
            $Data['profile_image'] = $filename;
        }
        $Data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type'=> 'success'
        );

        return redirect()->route('admin.profile')->with($notification);
    }//End Method

    public function ChangePassword(){
       
        return view('admin.admin_password_change');


    }//End Method

    public function UpdatePassword(Request $request){
        $validateData = $request->validate([
            'oldpassword' => 'required', 
            'newpassword' => 'required', 
            'confirmnewpassword' => 'required|same:newpassword',
        ]);

        $hashedPassword = Auth::user()->password;

        if(Hash::check($request->oldpassword,$hashedPassword)){
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->newpassword);
            $users->save();

            session()->flash('message','Password Updated Successfull');

            return redirect('login');
        }else{
            session()->flash('message','Old Password is not match');

            return redirect()->back(); 
        }

       

    }//End Method
    
}
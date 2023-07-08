<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class AdminController extends Controller
{
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
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

        return redirect()->route('admin.profile');
    }//End Method
    
}
<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use Image;

class AboutController extends Controller
{
    public function AboutPage(){
        $aboutPage = About::find(1);

        return view('admin.about_page.about_page_all', compact('aboutPage'));

    } //End Method

    public function UpdateAbout(Request $request){
        $about_id = $request->id;

        if($request->file('about_image')){
            $image = $request->file('about_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            
            Image::make($image)->resize(523,605)->save('uploaded/about_image/'.$name_gen);
            $save_url = 'uploaded/about_image/'.$name_gen;

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' => $save_url,

            ]);
            $notification = array(
                'message' => 'About Page Updated Successfully With Image',
                'alert-type'=> 'success'
            );
    
            return redirect()->back()->with($notification);         
        }else{
            About::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                

            ]);
            $notification = array(
                'message' => 'About Page Updated Successfully Without Image',
                'alert-type'=> 'success'
            );
    
            return redirect()->back()->with($notification);

        }//End Else

        

    } //End Method

}

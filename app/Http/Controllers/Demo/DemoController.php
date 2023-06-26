<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function Index(){
        return view('about');
    } //end mathod
    public function ContactMethod(){
        return view('contact');
    } //end mathod
}

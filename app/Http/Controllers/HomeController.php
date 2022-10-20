<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // LA PAGE POUR LA VUE HOME.BLADE.PHP
    public function home(){
        return view('home.home');
    }


     // LA PAGE POUR LA VUE ABOUT.BLADE.PHP
    public function about(){
        return view('home.about');
    }
    //

    public function dashboard(){
        return view('home.dashboard');
    }
    
}

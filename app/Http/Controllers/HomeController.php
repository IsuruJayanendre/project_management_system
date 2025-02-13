<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::user()->usertype == 'superadmin')
        {
            return view('test');
        }
        else if (Auth::user()->usertype == 'marketing') {
            return view('marketing.dashboard');
        } 
        
        else {
            $data = User::where('usertype', 'user')->get();
            return view ('admin.dashboard',compact('data'));
        }
        
       
    }
}

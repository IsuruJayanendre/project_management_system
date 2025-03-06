<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $projectCount = Project::count();
        $userCount = User::count();
        return view('test', compact('projectCount', 'userCount'));
       
    }
}

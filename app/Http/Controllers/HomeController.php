<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Employee\TaxHistory;
use App\Employee\Employee;
class HomeController extends Controller
{
    
    public function index()
    {
        return view('index');
    }

   
    public function about()
    {
       return view('about');
    }

    public function contact()
    {
        return view('contact');    
    }

    public function pricing()
    {
        return view('pricing');    
    }
}

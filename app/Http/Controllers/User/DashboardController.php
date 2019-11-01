<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CountryCode;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('user.index');
    }
     public function coverageList(Request $request)
    {
        
        $country_codes = [];
        $request->session()->put('country',$request->country);
        $countries = CountryCode::distinct()->get(['country']);
        if($request->country){
            $country_codes = CountryCode::where('country',$request->country)->get();
        }
        return view('user.coverage_lists',compact('country_codes','countries'));
    }

  

   

   
    
}

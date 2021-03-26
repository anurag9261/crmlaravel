<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Admin;
use App\Customer;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = DB::table('admins')->count();
        $profile = Admin::orderBy('id', 'desc')->take(3)->get();
        $customers = Customer::orderBy('id', 'desc')->take(3)->get();
        $customer = DB::table('customers')->count();
        return view('admin.dashboard',compact('customer','user','profile','customers'));
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    
}

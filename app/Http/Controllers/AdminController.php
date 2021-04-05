<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Session;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Customer;
use App\Invoice;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile['profile'] = DB::table('admins')->orderBy('created_at','desc')->paginate(5);
        return view('admin.users.index',$profile);
    }

    // public function login(Request $request){
    //     $this->validate($request,[
    //         'email' => 'required',
    //         'password' => 'required'
    //     ]);
    //     if(Auth::Admin()->role == 'Admin'){
    //         return 'logged in successfully';
    //     }
    //     return 'oops Something went Wrong';
    // }

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $roles = DB::table('roles')->where('status', 'Active')->get();
        return view('admin.users.adduser', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            
        $profile = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'mobno' => 'required',
            'email' => 'required',
            'address' => 'required',
            'image' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);
            $profile=new Admin();
            $profile->fname = $request->get('fname');
            $profile->lname = $request->get('lname');
            $profile->mobno = $request->get('mobno');
            $profile->email = $request->get('email');
            $profile->address = $request->get('address');
            $imageName = time().'.'.$request->image->extension();       
            $request->image->move(public_path('images'), $imageName);
            $profile->image = $imageName;
            $profile->role = $request->get('role');
            $profile->password = Hash::make($request->get('password'));     
            $profile->save();
            return redirect('users')->with('message', 'Record added successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function view(Admin $admin,$id){
        $profile = Admin::find($id);
        return view('admin.users.viewuser',compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin,$id)
    {
        $profile = Admin::find($id);
        $roles = DB::table('roles')->where('status', 'Active')->get();
        return view('admin.users.edituser', compact('roles','profile'));
        //return view('admin.edituser',compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin,$id)
    {
       
        $profile = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'mobno' => 'required',
            'email' => 'required',
            'address' => 'required',
            // 'image' => 'required',
            'role' => 'required',
        ]);
        $profile=Admin::find($id);  
        if( $request->image == ""){
            $imageName = $profile->image;
        }else{
            $imageName = time().'.'.$request->image->extension();       
            $request->image->move(public_path('images'), $imageName);
            $profile->image = $imageName;
        }
        $profile->fname = $request->get('fname');
        $profile->lname = $request->get('lname');
        $profile->mobno = $request->get('mobno');
        $profile->email = $request->get('email');
        $profile->address = $request->get('address');
        $profile->image = $imageName;
        $profile->role = $request->get('role');
        $profile->save();
        return redirect('users')->with('message', 'Record updated successfully!');
    }

    public function editpassword(){

        return view('admin.changepassword');
    }

    public function updatepassword(Request $request,$id){
 
        $profile=Admin::find($id);
        if(!(Hash::check($request->get('currentpassword'),Auth::user()->password))){
            return back()->with('error','Your current password does not match with what you provide');
        }

        if(strcmp($request->get('currentpassword'),$request->get('newpassword')) == 0){
            return back()->with('error','Your current password can not be same with new password');
        }
        $request->validate([
            'currentpassword'=>'required',
            'confirmpassword'=>'required|confirmed'
        ]);
        $profile->password = bcrypt($request->get('newpassword'));
        $profile->save();
        return redirect('admin')->with('message', 'Password is updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin,$id)
    {
        Admin::destroy(array('id',$id));
        return redirect('users')->with('error', 'Record deleted successfully!');
    }

    // public function search(Request $request){
    //     // Get the search value from the request
    //     $search = $request->input('search');
    
    //     // Search in the title and body columns from the posts table
    //     $profile['profile'] = Admin::query()
    //         ->where('role', 'LIKE', "%{$search}%")
    //         ->orWhere('fname', 'LIKE', "%{$search}%")
    //         ->get();
    
    //     // Return the search view with the resluts compacted
    //     //return view('admin.users', compact('profile'));
    //     return view('admin.users',compact('profile'));
    // }

    public function adminHome()
    {
        //for card count
        $admin = DB::table('admins')->where('role','Admin')->count();
        $employee = DB::table('admins')->where('role','Employee')->count();
        $customer = DB::table('customers')->count();

        //for pie chart
        


        //for table display
        $profile = Admin::orderBy('created_at','desc')->take(3)->get();
        $customers = Customer::orderBy('created_at','desc')->take(3)->get();
        $invoice = Invoice::orderBy('created_at','desc')->take(3)->get();
        return view('admin.dashboard',compact('customer','admin','profile','customers','employee','invoice'));
    }

}

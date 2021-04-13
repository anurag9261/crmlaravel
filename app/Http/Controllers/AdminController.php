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

    public function index()
    {
        $profile['profile'] = DB::table('admins')->orderBy('created_at','desc')->paginate(5);
        return view('admin.users.index',$profile);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $roles = DB::table('roles')->where('status', 'Active')->get();
        return view('admin.users.adduser', compact('roles'));
    }

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
            'status'=>'required',
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
        $profile->status = $request->get('status');
        $profile->password = Hash::make($request->get('password'));
        $profile->save();
        return redirect('users')->with('message', 'Record added successfully!');

    }

    public function view(Admin $admin,$id){
        $profile = Admin::find($id);
        return view('admin.users.viewuser',compact('profile'));
    }

    public function edit(Admin $admin,$id)
    {
        $profile = Admin::find($id);
        $roles = DB::table('roles')->where('status', 'Active')->get();
        return view('admin.users.edituser', compact('roles','profile'));
    }

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
            'status' => 'required',
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
        $profile->status = $request->get('status');
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

    public function destroy(Admin $admin,$id)
    {
        Admin::destroy(array('id',$id));
        return redirect('users')->with('error', 'Record deleted successfully!');
    }

    public function adminHome()
    {
        //for card count
        $admin = DB::table('admins')->where('role','Admin')->count();
        $employee = DB::table('admins')->where('role','Employee')->count();
        $customer = DB::table('customers')->count();
        $invoice_paid = DB::table('invoices')->where('status','Paid')->count();

        //for pie chart
        $paid = DB::table('invoices')->where('status', 'Paid')->get();
        $pending = DB::table('invoices')->where('status', 'Pending')->get();
        $paid_count = count($paid);
        $pending_count = count($pending);
        $total = Invoice::count();
        $paid_1 = $paid_count / $total * 100;
        $pending_1 = $pending_count / $total * 100;


        //for table display
        $profile = Admin::orderBy('created_at','desc')->where('role','employee')->take(3)->get();
        $customers = Customer::orderBy('created_at','desc')->take(3)->get();
        $invoice = Invoice::orderBy('created_at','desc')->take(3)->get();
        return view('admin.dashboard',compact('paid_1','pending_1','customer','admin','profile','customers','employee','invoice','invoice_paid'));
    }

}

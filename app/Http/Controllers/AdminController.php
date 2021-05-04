<?php

namespace App\Http\Controllers;

use Session;
use App\Admin;
use App\Invoice;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{

    public function index()
    {
        if (Auth::user()->role == 'Admin') {
            $config['config'] = DB::table('configurations')->where('id', '1')->get();
            return view('admin.users.index', $config);
        } else {
            return Redirect('/admin');
        }
    }

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getUsers(Request $request)
    {
        $admins = Admin::all();
        return datatables()->of($admins)
                ->addColumn('status',function ($admins) {
                    if ($admins->status == '1') {
                        return "Active";
                    } else {
                        return "InActive";
                    }
                    return $admins;
                })->addColumn('action', function ($row) {

                $html = '<a href="viewuser' . $row->id . '" class="btn"><i class="far fa-eye"></i></a> ';
                $html .= '<a href="edituser' . $row->id . '" class="btn"><i class="fas fa-pencil-alt"></i></a> ';
                $html .= '<a href="deleteuser' . $row->id . '" class="btn" onclick="myFunction()"><i class="far fa-trash-alt"></i></a>';
                return $html;
            })->toJson();

    }

    public function create()
    {
        if (Auth::user()->role == 'Admin') {
            $roles = DB::table('roles')->where('status', 'Active')->get();
            $config = DB::table('configurations')->where('id', '1')->get();
            return view('admin.users.adduser', compact('roles','config'));
        } else {
            return Redirect('/admin');
        }
    }

    public function store(Request $request)
    {


        $profile = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'mobno' => 'required|min:10',
            'email' => 'required|string|email|max:255|unique:admins',
            'birthdate' => 'required',
            'joining_date' => 'required',
            'gender'=> 'required',
            'salary_type' => 'required',
            'address' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role' => 'required',
            'salary_amount' => 'required',
            'status'=>'required',
            'password' => 'required|min:6',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'gender' => 'required',
            'zipcode' => 'required'
        ]);
        $profile=new Admin();
        $profile->fname = $request->get('fname');
        $profile->lname = $request->get('lname');
        $profile->mobno = $request->get('mobno');
        $profile->email = $request->get('email');
        $profile->birthdate = $request->get('birthdate');
        $profile->gender = $request->get('gender');
        $profile->joining_date = $request->get('joining_date');
        $profile->address = $request->get('address');
        $profile->city = $request->get('city');
        $profile->zipcode = $request->get('zipcode');
        $profile->state = $request->get('state');
        $profile->country = $request->get('country');
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $profile->image = $imageName;
        $profile->role = $request->get('role');
        $profile->salary_type = $request->get('salary_type');
        $profile->salary_amount = $request->get('salary_amount');
        $profile->status = $request->get('status');
        $profile->password = Hash::make($request->get('password'));
        $profile->save();
        return redirect('users')->with('message', 'Record added successfully!');

    }

    public function view(Admin $admin,$id){

        if (Auth::user()->role == 'Admin') {
            $profile = Admin::find($id);
            $config = DB::table('configurations')->where('id', '1')->get();
            return view('admin.users.viewuser',compact('profile','config'));
        } else {
            return Redirect('/admin');
        }
    }

    public function edit(Admin $admin,$id)
    {
        if (Auth::user()->role == 'Admin') {
            $profile = Admin::find($id);
            $config = DB::table('configurations')->where('id', '1')->get();
            $roles = DB::table('roles')->where('status', 'Active')->get();
            return view('admin.users.edituser', compact('roles','profile','config'));
        } elseif(Auth::user()->id == $id) {
            $profile = Admin::find($id);
            $config = DB::table('configurations')->where('id', '1')->get();
            $roles = DB::table('roles')->where('status', 'Active')->get();
            return view('admin.users.edituser', compact('roles','profile','config'));
        }else{
            return Redirect('/admin');
        }
    }

    public function update(Request $request, Admin $admin,$id)
    {
        $profile = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'mobno' => 'required',
            'email' => 'required',
            'birthdate' => 'required',
            'joining_date' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'role' => 'required',
            'status' => 'required',
            'salary_type' => 'required',
            'salary_amount' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zipcode' => 'required',
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
        $profile->birthdate = $request->get('birthdate');
        $profile->joining_date = $request->get('joining_date');
        $profile->gender = $request->get('gender');
        $profile->address = $request->get('address');
        $profile->city = $request->get('city');
        $profile->zipcode = $request->get('zipcode');
        $profile->state = $request->get('state');
        $profile->country = $request->get('country');
        $profile->image = $imageName;
        $profile->role = $request->get('role');
        $profile->salary_type = $request->get('salary_type');
        $profile->salary_amount = $request->get('salary_amount');
        $profile->status = $request->get('status');
        $profile->save();
        return redirect('users')->with('message', 'Record updated successfully!');
    }

    public function editpassword($id){
        $config = DB::table('configurations')->where('id', '1')->get();
        return view('admin.changepassword',compact('config'));
    }

    public function updatepassword(Request $request){

        if(!(Hash::check($request->get('currentpassword'),Auth::user()->password))){
            return back()->with('error','Your current password does not match with what you provide');
        }
        if(strcmp($request->get('currentpassword'),$request->get('newpassword')) == 0){
            return back()->with('error','Your current password can not be same with new password');
        }
        $request->validate([
            'currentpassword'=>'required|min:6',
            'newpassword'=>'required|min:6|same:confirmpassword'
        ]);
        $profile = Admin::find(auth()->user()->id);
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
        $paid = Invoice::where('status', 'Paid')->get();
        $pending = Invoice::where('status', 'Pending')->get();
        $paid_count = count($paid);
        $pending_count = count($pending);
        $total = Invoice::count();
        if($paid_count == 0){
            $paid_1 = 0;
        }else{
            $paid_1 = $paid_count / $total * 100;
        }
        if($pending_count == 0){
            $pending_1 = 0;
        }else{
            $pending_1 = $pending_count / $total * 100;
        }
        $config = DB::table('configurations')->where('id', '1')->get();

        //for static chart
        $Hourly = Admin::where('salary_type','1')->where('role','Employee')->count();
        $Monthly = Admin::where('salary_type', '2')->where('role','Employee')->count();

        //for table display
        $profile = Admin::orderBy('created_at','desc')->where('role','employee')->take(3)->get();
        $customers = Customer::orderBy('created_at','desc')->take(3)->get();
        $invoice = Invoice::orderBy('created_at','desc')->take(3)->get();
        return view('admin.dashboard',compact('paid_1','pending_1','customer','admin','profile','customers','employee','config','invoice','invoice_paid','Monthly','Hourly'));
    }

}

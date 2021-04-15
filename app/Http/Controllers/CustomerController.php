<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Validator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Seesion;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
class CustomerController extends Controller
{

    public function index()
    {
        $profile['profile'] = DB::table('customers')->orderBy('created_at','desc')->paginate(5);
        return view('admin.customers.index',$profile);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getCustomers(Request $request)
    {
        $customers = Customer::all();
        return datatables()->of($customers)
            ->addColumn('action', function ($row) {
                $html = '<a href="viewcustomer' . $row->id . '" class="btn btn-sm btn-secondary"><i class="far fa-eye"></i></a> ';
                $html .= '<a href="editcustomer' . $row->id . '" class="btn btn-sm btn-secondary"><i class="far fa-edit"></i></a> ';
                $html .= '<a href="deletecustomer' . $row->id . '" class="btn btn-sm btn-secondary"><i class="far fa-trash-alt"></i></a>';
                return $html;
            })->toJson();
    }

    public function create()
    {
        return view('admin.customers.addcustomer');
    }

    public function store(Request $request)
    {

        $profile = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'mobno' => 'required',
            'email' => 'required',
            'address' => 'required',
            'gender' =>'required',
            'birthdate' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'password' => 'required',
        ]);
        $profile=new Customer();
        $profile->fname = $request->get('fname');
        $profile->lname = $request->get('lname');
        $profile->mobno = $request->get('mobno');
        $profile->email = $request->get('email');
        $profile->gender = $request->get('gender');
        $profile->birthdate = $request->get('birthdate');
        $profile->address = $request->get('address');
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $profile->image = $imageName;
        $profile->status = $request->get('status');
        $profile->password = $request->get('password');
        $profile->save();
        return redirect('customers')->with('message', 'Record saved successfully!');
    }

    public function edit(Customer $customer,$id)
    {
        $profile = Customer::find($id);
        return view('admin.customers.editcustomer',compact('profile'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'mobno' => 'required',
            'email' => 'required',
            'address' => 'required',
            // 'image' => 'required',
            'status' => 'required',
            //'password' => 'required',
            'address' => 'required',
            'gender' => 'required',
        ]);
        $profile=Customer::find($id);
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
        $profile->gender = $request->get('gender');
        $profile->birthdate = $request->get('birthdate');
        $profile->address = $request->get('address');
        $profile->status = $request->get('status');
        $profile->save();
        return redirect('customers')->with('message', 'Record updated successfully!');
    }

    public function destroy(Customer $customer,$id)
    {
        Customer::destroy(array('id',$id));
        return redirect('customers')->with('error', 'Record deleted successfully!');
    }

    public function view(Customer $customer,$id){
        $profile = Customer::find($id);
        return view('admin.customers.viewcustomer',compact('profile'));
    }

}


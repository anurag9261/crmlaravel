<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Validator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Seesion;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile['profile'] = DB::table('customers')->orderBy('created_at','desc')->paginate(5);
        return view('admin.customers.index',$profile);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.addcustomer');
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
            'status' => 'required',
            'password' => 'required',
        ]);
        $profile=new Customer();
        $profile->fname = $request->get('fname');
        $profile->lname = $request->get('lname');
        $profile->mobno = $request->get('mobno');
        $profile->email = $request->get('email');
        $profile->address = $request->get('address');
        $imageName = time().'.'.$request->image->extension();       
        $request->image->move(public_path('images'), $imageName);
        $profile->image = $imageName;
        $profile->status = $request->get('status');
        $profile->password = $request->get('password');     
        $profile->save();
        return redirect('customers')->with('message', 'Record saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer,$id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer,$id)
    {
        $profile = Customer::find($id);
        return view('admin.customers.editcustomer',compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
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
        $profile->address = $request->get('address');
        $profile->status = $request->get('status');
        $profile->save();
        return redirect('customers')->with('message', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
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


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Session;
use Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        //return view('admin.users')->with('profile',User::all());
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    // public function edit(Request $request,$id){
    //     return view('admin.profile')->where(User::find($id));
    // }
    public function edit($id){

       $profile = User::find($id);
       return view('admin.profile', compact('profile'));
    }

    public function update(Request $request,$id){

       /* $this->validate($request,[
           'name'=>'required',
           'email'=>'required',
           'password'=>'password' 
        ]);*/
        $profile=User::find($id);
        $profile->name = $request->get('name');
        $profile->email = $request->get('email');
        $profile->password = $request->get('password');
        $profile->save();
        return redirect('/');
    }

    public function editpassword(){

        return view('admin.changepassword');
    }

    public function updatepassword(Request $request,$id){
 
        if(!(Hash::check($request->get('currentpassword'),Auth::user()->password))){
            return back()->with('error','Your Current Password Does not match');
        }

        if(strcmp($request->get('currentpassword'),$request->get('newpassword')) == 0){
            return back()->with('error','Your New Password Does not same with new Password');
        }
        $profile=User::find($id);
        $profile->password = bcrypt($request->get('newpassword'));
        $profile->save();
        return redirect('/');
    }

}
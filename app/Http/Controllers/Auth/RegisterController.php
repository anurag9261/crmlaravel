<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Admin;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Auth\Request;
use Illuminate\Mail\Transport\ArrayTransport;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //  'fname' => ['required'],
            //   'lname' => ['required'],
            //  'mobno' => ['required','max:10'],
            //   'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //   'address' => ['required'],
            // // 'image' => ['required'],
            //   'role' => ['required'],
            //   'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        return Admin::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'mobno' => $data['mobno'],
            'email' => $data['email'],
            'address' => $data['address'],
            // $imageName = time().'.'.$request->image->extension(),       
            // $request->image->move(public_path('images'), $imageName),
            // 'image' => $data['image'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
            
        ]);
    }
}

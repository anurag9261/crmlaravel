<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile['profile'] = Role::paginate(5);
        return view('admin.roles.index',$profile);
    }

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
        return view('admin.roles.addrole');
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
            'title' => 'required',
            'status' => 'required',
        ]);
            $profile=new Role();
            $profile->title = $request->get('title');
            $profile->status = $request->get('status');
            $profile->save();
            return redirect('roles')->with('message', 'Role Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */

    public function view(Role $role,$id){
        $profile = Role::find($id);
        return view('admin.roles.viewrole',compact('profile'));
    }
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role,$id)
    {
        $profile = Role::find($id);
        return view('admin.roles.editrole',compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role,$id)
    {
        $profile = $request->validate([
            'title' => 'required',
            'status' => 'required',
        ]);
        $profile = Role::find($id);
            $profile->title = $request->get('title');
            $profile->status = $request->get('status');
            $profile->save();
            return redirect('roles')->with('message', 'Role Update Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role,$id)
    {
        Role::destroy(array('id',$id));
        return redirect('roles')->with('error', 'Role Deleted Successfully!');
    }
}
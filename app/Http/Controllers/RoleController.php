<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $profile['profile'] = Role::paginate(5);
        return view('admin.roles.index',$profile);
    }

    public function getRoles(Request $request)
    {
        $roles = Role::all();
        return datatables()->of($roles)
            ->addColumn('action', function ($row) {
                $html = '<a href="viewrole' . $row->id . '" class="btn btn-sm btn-secondary"><i class="far fa-eye"></i></a> ';
                $html .= '<a href="editrole' . $row->id . '" class="btn btn-sm btn-secondary"><i class="far fa-edit"></i></a> ';
                $html .= '<a href="deleterole' . $row->id . '" class="btn btn-sm btn-secondary"><i class="far fa-trash-alt"></i></a>';
                return $html;
            })->toJson();
    }

    public function create()
    {
        return view('admin.roles.addrole');
    }


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
            return redirect('roles')->with('message', 'Role added successfully!');
    }


    public function view(Role $role,$id){
        $profile = Role::find($id);
        return view('admin.roles.viewrole',compact('profile'));
    }
    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role,$id)
    {
        $profile = Role::find($id);
        return view('admin.roles.editrole',compact('profile'));
    }


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
            return redirect('roles')->with('message', 'Role update successfully!');
    }

    public function destroy(Role $role,$id)
    {
        Role::destroy(array('id',$id));
        return redirect('roles')->with('error', 'Role deleted successfully!');
    }
}

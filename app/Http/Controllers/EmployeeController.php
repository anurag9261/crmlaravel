<?php

namespace App\Http\Controllers;

use DateTime;
use App\Admin;
use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Carbon;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon as SupportCarbon;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (Auth::user()->role == 'Admin') {
            $admin = DB::table('admins')
                ->select('admins.id', 'admins.fname', 'admins.lname','employees.*')
                ->join('employees', 'admin_id', '=', 'admins.id')
            ->get();
            $employeData['emp'] =   Employee::get();
            $row = 0;
            foreach($employeData['emp'] as $employee){
                $inTimeResult = $employee->intime;
                $outTimeResult = $employee->outtime;
                $time1 = new DateTime($inTimeResult);
                $time2 = new DateTime($outTimeResult);
                $interval = $time1->diff($time2);
                $employeData['emp'][$row]['time'] = $interval->format('%H:%I:%S');
                $row++;
            }
            $config = DB::table('configurations')->where('id', '1')->get();
            return view('admin.employees.index',compact('employeData','admin','config'));
        } else {
            return Redirect('/admin');
        }
    }

    public function getEmployees(Request $request)
    {

        $employees = Employee::join('admins', 'admins.id', '=', 'employees.admin_id')
                                ->select('employees.*', 'admins.fname', 'admins.lname')
                                ->get();
        return datatables()->of($employees)
            ->addColumn('admin_id', function ($admins) {
                return $admins->fname.' '.$admins->lname;
            })
            ->addColumn('', function ($admins) {
                if ($admins->status == 1) {
                    return "Active";
                } else {
                    return "In Active";
                }
            })
            ->addColumn('action', function ($row) {
                $html = '<a href="viewemployee' . $row->id . '" class="btn btn-sm btn-secondary"><i class="far fa-eye"></i></a> ';
                $html .= '<a href="editemployee' . $row->id . '" class="btn btn-sm btn-secondary"><i class="far fa-edit"></i></a> ';
                $html .= '<a href="deleteemployee' . $row->id . '" class="btn btn-sm btn-secondary" onclick="myFunction()"><i class="far fa-trash-alt"></i></a>';
                return $html;
            })->toJson();
    }

    public function create()
    {
        if (Auth::user()->role == 'Admin') {
            $employee = DB::table('admins')->where('role', 'Employee')->get();
            $config = DB::table('configurations')->where('id', '1')->get();
            return view('admin.employees.addemployee', compact('employee','config'));
        } else {
            return Redirect('/admin');
        }
    }

    public function store(Request $request)
    {
        $profile = $request->validate([
            'currentdate' => 'required',
            'employee' =>'required',
            'attandance' => 'required',
        ]);
        $profile=new Employee();
        $profile->admin_id = $request->get('employee');
        $profile->attandance = $request->get('attandance');
        if($request->get('attandance') == 'present' ){
            $profile->intime = $request->get('intime');
            $profile->outtime = $request->get('outtime');

        }else{
            $profile->intime = $request->get('');
            $profile->outtime = $request->get('');
        }
        $profile->currentdate = $request->get('currentdate');
        $profile->save();
        return redirect('employees')->with('message', 'Record added successfully!');

    }

    public function edit(Employee $employee,$id)
    {
        if (Auth::user()->role == 'Admin') {
            $admin = Employee::find($id);
            $employee = Admin::select('admins.id', 'admins.fname','admins.lname','employees.*')
                                ->join('employees', 'admin_id', '=', 'admins.id')
                                ->where('admins.id', '=', $admin->admin_id)->get();
            $config = DB::table('configurations')->where('id', '1')->get();
            return view('admin.employees.editemployee', compact('admin','employee','config','id'));
        }else{
            return Redirect('/admin');
        }
    }

    public function update(Request $request, Employee $employee,$id)
    {

        $profile = $request->validate([
            'currentdate' => 'required',
        ]);
        $profile=Employee::find($id);
        $profile->admin_id = $request->get('admin_id');
        $profile->attandance = $request->get('attandance');
        if($request->get('attandance') == 'present' ){
            $profile->intime = $request->get('intime');
            $profile->outtime = $request->get('outtime');

        }else{
            $profile->intime = $request->get('');
            $profile->outtime = $request->get('');
        }
        $profile->currentdate = $request->get('currentdate');
        $profile->save();
        return redirect('employees')->with('message', 'Record updated successfully!');
    }

    public function view(Employee $employee,$id){
        if (Auth::user()->role == 'Admin') {
            $admin = Employee::find($id);

            $profile = Admin::select('admins.id', 'admins.fname', 'admins.lname', 'employees.*')
                ->join('employees', 'admin_id', '=', 'admins.id')
                ->where('admins.id', '=', $admin->admin_id)->get();
            $config = DB::table('configurations')->where('id', '1')->get();
            // echo "<pre>";
            // print_r($profile[0]->fname);
            // die;
            return view('admin.employees.viewemployee',compact('profile','config'));
        }else {
            return Redirect('/admin');
        }
    }

    public function destroy(Employee $employee,$id)
    {
        Employee::destroy(array('id',$id));
        return redirect('employees')->with('error', 'Record deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use App\Http\Controllers\Carbon;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Support\Carbon as SupportCarbon;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        // $profile = Employee::paginate(5);
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
        return view('admin.employees.index',compact('employeData'));
    }

    public function getEmployees(Request $request)
    {
        $employees = Employee::all();
        return datatables()->of($employees)
            ->addColumn('action', function ($row) {
                $html = '<a href="viewemployee' . $row->id . '" class="btn btn-sm btn-secondary"><i class="far fa-eye"></i></a> ';
                $html .= '<a href="editemployee' . $row->id . '" class="btn btn-sm btn-secondary"><i class="far fa-edit"></i></a> ';
                $html .= '<a href="deleteemployee' . $row->id . '" class="btn btn-sm btn-secondary"><i class="far fa-trash-alt"></i></a>';
                return $html;
            })->toJson();
    }

    public function create()
    {
        $employee = DB::table('admins')->where('role', 'Employee')->get();
        return view('admin.employees.addemployee', compact('employee'));
    }

    public function store(Request $request)
    {
        $profile = $request->validate([
            // 'employee' => 'required',
            // 'attandance' => 'required',
            'currentdate' => 'required',
        ]);
        // echo "<pre>"; print_r($request->all()); die;
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
        $admin = Employee::find($id);
        $employee = DB::table('admins')->where('role', 'Employee')->get();
        return view('admin.employees.editemployee', compact('admin','employee'));
    }

    public function update(Request $request, Employee $employee,$id)
    {
        $profile = $request->validate([
            // 'employee' => 'required',
            // 'attandance' => 'required',
            'currentdate' => 'required',
        ]);
        $profile=Employee::find($id);
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
        return redirect('employees')->with('message', 'Record updated successfully!');
    }

    public function view(Employee $employee,$id){
        $profile = Employee::find($id);
        return view('admin.employees.viewemployee',compact('profile'));
    }

    // public function exportCsv(Request $request)
    // {
    //     $fileName = 'Employees.csv';
    //     $tasks = Employee::all();

    //     $headers = array(
    //         "Content-type"        => "text/csv",
    //         "Content-Disposition" => "attachment; filename=$fileName",
    //         "Pragma"              => "no-cache",
    //         "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
    //         "Expires"             => "0"
    //     );

    //     $columns = array('Employee', 'Attandance', 'Currentdate', 'Total Time');

    //     $callback = function() use($tasks, $columns) {
    //         $file = fopen('php://output', 'w');
    //         fputcsv($file, $columns);

    //         foreach ($tasks as $task) {
    //             $row['Employee']  = $task->employee;
    //             $row['Attandance']    = $task->attandance;
    //             $row['Currentdate']    = $task->currentdate;
    //             $inTimeResult = $task->intime;
    //             $outTimeResult = $task->outtime;
    //             $time1 = new DateTime($inTimeResult);
    //             $time2 = new DateTime($outTimeResult);
    //             $interval = $time1->diff($time2);
    //             $row['Total Time'] = $interval->format('%H:%I:%S');
    //             fputcsv($file, array($row['Employee'], $row['Attandance'], $row['Currentdate'], $row['Total Time']));
    //         }

    //         fclose($file);
    //     };

    //     return response()->stream($callback, 200, $headers);
    // }

    public function destroy(Employee $employee,$id)
    {
        Employee::destroy(array('id',$id));
        return redirect('employees')->with('error', 'Record deleted successfully!');
    }
}

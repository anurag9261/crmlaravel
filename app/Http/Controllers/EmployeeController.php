<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use DB;
use DateTime;
use App\Http\Controllers\Carbon;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Support\Carbon as SupportCarbon;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        //  dd($employeData);
        return view('admin.employees.index',compact('employeData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee = DB::table('admins')->where('role', 'Employee')->get();
        return view('admin.employees.addemployee', compact('employee'));
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
            'employee' => 'required',
            // 'attandance' => 'required',
            'currentdate' => 'required',
        ]);
        $profile=new Employee();
        $profile->employee = $request->get('employee');
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
        return redirect('employees')->with('message', 'Records Added Successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee,$id)
    {
        $admin = Employee::find($id);
        $employee = DB::table('admins')->where('role', 'Employee')->get();
        return view('admin.employees.editemployee', compact('admin','employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee,$id)
    {
        $profile = $request->validate([
            // 'employee' => 'required',
            // 'attandance' => 'required',
            'currentdate' => 'required',
        ]);
        $profile=Employee::find($id); 
        $profile->employee = $request->get('employee');
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
        return redirect('employees')->with('message', 'Records Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    

    public function view(Employee $employee,$id){
        $profile = Employee::find($id);
        return view('admin.employees.viewemployee',compact('profile'));
    }

    public function exportCsv(Request $request)
    {
        $fileName = 'Employees.csv';
        $tasks = Employee::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Employee', 'Attandance', 'Currentdate', 'Total Time');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Employee']  = $task->employee;
                $row['Attandance']    = $task->attandance;
                $row['Currentdate']    = $task->currentdate;
                $inTimeResult = $task->intime;
                $outTimeResult = $task->outtime;
                $time1 = new DateTime($inTimeResult);
                $time2 = new DateTime($outTimeResult);
                $interval = $time1->diff($time2);
                $row['Total Time'] = $interval->format('%H:%I:%S');
                fputcsv($file, array($row['Employee'], $row['Attandance'], $row['Currentdate'], $row['Total Time']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function destroy(Employee $employee,$id)
    {
        Employee::destroy(array('id',$id));
        return redirect('employees')->with('error', 'Record Deleted Successfully!');
    }
}

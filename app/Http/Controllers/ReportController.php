<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Employee;
use DateTime;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reports.employee');
    }

    public function timesheet(){

        $employee = DB::table('admins')->where('role', 'Employee')->get();
        return view('admin.reports.timesheet',compact('employee'));
    }

    public function invoice()
    {

        $customer = DB::table('customers')->get();
        return view('admin.reports.invoice', compact('customer'));
    }

    public function balancesheet()
    {
        return view('admin.reports.balance');
    }

    public function generatePDF(Request $request)
    {
        // dd($request->all());
        // $employeData['emp'] =   Employee::get();
        $employeData =  DB::table('employees')
                                //  ->select('employees.*','admins.fname','admins.lname')
                                // ->join('admins','admins.fname','=','employees.employee')
                                ->whereMonth('employees.currentdate',$request->get('month'))
                                ->where('employees.employee', $request->get('employee'))
                                ->get();
        $data = ['title' => 'Welcome to CRM'];
        $pdf = PDF::loadView('myPDF', $data,compact('employeData'));
        return $pdf->download('employeereport.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }


}

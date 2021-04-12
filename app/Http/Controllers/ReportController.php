<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Employee;
use DateTime;
use App\Invoice;

class ReportController extends Controller
{

    public function timesheet(){

        $employee = DB::table('admins')->where('role', 'Employee')->get();
        return view('admin.reports.timesheet',compact('employee'));
    }


    public function timesheetPDF(Request $request)
    {
        // dd($request->all());
        // $employeData['emp'] =   Employee::get();
        $employeData =  DB::table('employees')
                                //  ->select('employees.*','admins.fname','admins.lname')
                                // ->join('admins','admins.fname','=','employees.employee')
                                ->whereMonth('employees.currentdate',$request->get('month'))
                                ->where('employees.employee', $request->get('employee'))
                                ->get();
        $data = ['title' => 'CRM', $employee = $request->get('employee')];
        $pdf = PDF::loadView('myPDF', $data,compact('employeData','employee'));
        return $pdf->download('timesheetreport.pdf');
    }

    public function balancesheet()
    {
        return view('admin.reports.balance');
    }

    public function employee()
    {
        return view('admin.reports.employee');
    }

    public function employeePDF(Request $request)
    {
        $employeData =  DB::table('admins')
                        ->whereMonth('created_at', $request->get('month'))
                        ->where('admins.role', 'employee')
                        ->get();
        $data = ['title' => 'CRM', $employee = $request->get('employee')];
        $pdf = PDF::loadView('employeereport', $data, compact('employeData', 'employee'));
        return $pdf->download('employeereport.pdf');
    }

    public function invoice()
    {
        $customer = DB::table('customers')->get();
        return view('admin.reports.invoice', compact('customer'));
    }

    public function invoicePDF(Request $request)
    {
        $dataTable =  DB::table('invoices')
                        ->whereMonth('created_at', $request->get('month'))
                        ->where('bill_to', $request->get('customer'))
                        ->where('status', $request->get('status'))
                        ->get();
        $data = ['title' => 'CRM'];
        $pdf = PDF::loadView('invoicereport', $data, compact('dataTable'));
        return $pdf->download('employeereport.pdf');
    }

}

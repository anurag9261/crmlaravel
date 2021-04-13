<?php

namespace App\Http\Controllers;

use PDF;
use DateTime;
use Exception;
use App\Report;
use App\Invoice;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReportController extends Controller
{

    public function timesheet(){

        $employee = DB::table('admins')->where('role', 'Employee')->get();
        return view('admin.reports.timesheet',compact('employee'));
    }


    public function timesheetPDF(Request $request)
    {
        $employeData = $request->validate([
            'emp' => 'required',
            'month' => 'required',
        ]);
        $month = date('m', strtotime($request->get('month').'-01'));
        $errorMonth = date('F-Y', strtotime($request->get('month') . '-01'));
        $year =  date("Y", strtotime($request->get('month').'-01'));
        $employee = $request->get('emp');
        $employeData =  DB::table('employees')
                                //  ->select('employees.*','admins.fname','admins.lname')
                                // ->join('admins','admins.fname','=','employees.employee')
                                ->whereMonth('employees.currentdate',$month)
                                ->whereYear('employees.currentdate', $year)
                                ->where('employees.employee', $employee)
                                ->get();
        $array = (array)$employeData;
        foreach ($array as $newArray) {
            if (!empty($newArray)) {
                $data = ['title' => 'CRM', $employee];
                $pdf = PDF::loadView('myPDF', $data, compact('employeData', 'employee'));
                return $pdf->download('timesheetreport.pdf');
            } else {
                return back()->withError(' Data not found for ' . $errorMonth . '!');
            }
        }

    }

    public function balancesheet()
    {
        return view('admin.reports.balance');
    }

    public function balancesheetPDF(Request $request)
    {
        $employeData = $request->validate([
            'month' => 'required',
        ]);
        $errorMonth = date('F-Y', strtotime($request->get('month') . '-01'));
        $month = date('m', strtotime($request->get('month') . '-01'));
        $year =  date("Y", strtotime($request->get('month') . '-01'));
        $invoiceRecord =  DB::table('invoices')
                        ->whereMonth('current_date', $month)
                        ->whereYear('current_date',$year)
                        ->where('invoices.status', 'Paid')
                        ->get();
        $expenseRecord =  DB::table('expenses')
                        ->whereMonth('entry_date', $month)
                        ->whereYear('entry_date', $year)
                        ->get();
        $array = (array)$invoiceRecord;
        foreach ($array as $newArray) {
            if (!empty($newArray)) {
                $data = ['title' => 'CRM'];
                $pdf = PDF::loadView('balancereport', $data, compact('invoiceRecord', 'expenseRecord'));
                return $pdf->download('balancereport.pdf');
            } else {
                return back()->withError(' Data not found for ' . $errorMonth . '!');
            }
        }

    }

    public function employee(Request $request)
    {

        return view('admin.reports.employee');
    }

    public function employeePDF(Request $request)
    {
        $employeData = $request->validate([
            'month' => 'required',
            'status' => 'required',
        ]);
        $month = date('m', strtotime($request->get('month') . '-01'));
        $errorMonth = date('F-Y', strtotime($request->get('month') . '-01'));
        $year =  date("Y", strtotime($request->get('month') . '-01'));

        $employeData =  DB::table('admins')
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->where('admins.role', 'employee')
                        ->where('admins.status', $request->get('status'))
                        ->get();
        $array = (array)$employeData;
        foreach($array as $newArray){
            if (!empty($newArray)) {
                $data = ['title' => 'CRM', $employee = $request->get('employee')];
                $pdf = PDF::loadView('employeereport', $data, compact('employeData', 'employee'));
                return $pdf->download('employeereport.pdf');
            } else {
                return back()->withError(' Data not found for ' .$errorMonth. '!');
            }
        }
    }

    public function invoice(Request $request)
    {
        $customer = DB::table('customers')->get();
        if(!empty($request->all())){
        $dataTable = $request->validate([
            'month' => 'required',
            'status' => 'required',
            'customer' => 'required'
        ]);
            $month = date('m', strtotime($request->get('month') . '-01'));
            $year =  date("Y", strtotime($request->get('month') . '-01'));
            $errorMonth = date('F-Y', strtotime($request->get('month') . '-01'));
            $dataTable =  DB::table('invoices')
                            ->whereMonth('created_at', $month)
                                ->whereYear('created_at', $year)
                                ->where('bill_to', $request->get('customer'))
                                ->where('status', $request->get('status'))
                                ->get();
            $array = (array)$dataTable;
            foreach ($array as $newArray) {
                if (empty($newArray)) {
                    return back()->withError(' Data not found for ' . $errorMonth . '!');
                }
            }
        }else{
            $dataTable = 'no_data_found';
        }
        return view('admin.reports.invoice', compact('customer', 'dataTable'));
    }

    public function invoicePDF(Request $request,$id)
    {

        $invoice = Invoice::find($id);
        $productData =  DB::table('products')
                            ->where('invoice_id', $id)
                            ->get();
        //dd($productDatass);
        $data = ['title' => 'CRM'];
        $pdf = PDF::loadView('invoicereport', $data, compact('invoice','productData'));
        return $pdf->download('invoicereport.pdf');
    }

}

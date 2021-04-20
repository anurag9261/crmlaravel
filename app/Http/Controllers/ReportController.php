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

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function timesheet(){

        $employee = DB::table('admins')->where('role', 'Employee')->get();
        $config = DB::table('configurations')->where('id', '1')->get();
        return view('admin.reports.timesheet',compact('employee','config'));
    }


    public function timesheetPDF(Request $request)
    {
        $employeData = $request->validate([
            'emp' => 'required',
            'month' => 'required',
        ]);
        $config = DB::table('configurations')->where('id', '1')->get();
        $month = date('m', strtotime($request->get('month').'-01'));
        $errorMonth = date('F-Y', strtotime($request->get('month') . '-01'));
        $year =  date("Y", strtotime($request->get('month').'-01'));
        $employeeId = $request->get('emp');
        $employeData = DB::table('admins')
                                ->select('admins.id', 'admins.fname', 'admins.lname', 'admins.salary_amount', 'employees.*')
                                ->join('employees', 'admin_id', '=', 'admins.id')
                                ->whereMonth('employees.currentdate', $month)
                                ->whereYear('employees.currentdate', $year)
                                ->where('employees.admin_id', $employeeId)
                                ->get();
        $array = (array)$employeData;
        foreach ($array as $newArray) {
            if (!empty($newArray)) {
                $data = ['title' => 'CRM', $employeeId];
                $pdf = PDF::loadView('myPDF', $data, compact('employeData', 'employeeId','config'));
                return $pdf->download('timesheetreport.pdf');
            } else {
                return back()->withError(' Data not found for ' . $errorMonth . '!');
            }
        }

    }

    public function balancesheet()
    {
        $config = DB::table('configurations')->where('id', '1')->get();
        return view('admin.reports.balance',compact('config'));
    }

    public function balancesheetPDF(Request $request)
    {
        $employeData = $request->validate([
            'month' => 'required',
        ]);
        $config = DB::table('configurations')->where('id', '1')->get();
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
                $pdf = PDF::loadView('balancereport', $data, compact('invoiceRecord', 'expenseRecord','config'));
                return $pdf->download('balancereport.pdf');
            } else {
                return back()->withError(' Data not found for ' . $errorMonth . '!');
            }
        }

    }

    public function employee(Request $request)
    {
        $config = DB::table('configurations')->where('id', '1')->get();
        return view('admin.reports.employee',compact('config'));
    }

    public function employeePDF(Request $request)
    {
        $employeData = $request->validate([
            'month' => 'required',
            'status' => 'required',
        ]);
        $config = DB::table('configurations')->where('id', '1')->get();
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
                $pdf = PDF::loadView('employeereport', $data, compact('employeData', 'employee','config'));
                return $pdf->download('employeereport.pdf');
            } else {
                return back()->withError(' Data not found for ' .$errorMonth. '!');
            }
        }
    }

    public function invoice(Request $request)
    {
        $customer = DB::table('customers')->get();
        $config = DB::table('configurations')->where('id', '1')->get();
        if(!empty($request->all())){
        $dataTable = $request->validate([
            'month' => 'required',
            'status' => 'required',
            'customer' => 'required'
        ]);
            $config = DB::table('configurations')->where('id', '1')->get();
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
        return view('admin.reports.invoice', compact('customer', 'dataTable','config'));
    }

    public function invoicePDF(Request $request,$id)
    {

        $invoice = Invoice::find($id);
        $config = DB::table('configurations')->where('id', '1')->get();
        $productData =  DB::table('products')
                            ->where('invoice_id', $id)
                            ->get();
        //dd($productDatass);
        $data = ['title' => 'CRM'];
        $pdf = PDF::loadView('invoicereport', $data, compact('invoice','productData','config'));
        return $pdf->download('invoicereport.pdf');
    }

    public function generatepayslip(Request $request)
    {

        $employee = DB::table('admins')->where('role','Employee')->get();
        $config = DB::table('configurations')->where('id', '1')->get();
        return view('admin.reports.payslip', compact('employee','config'));
    }


    public function payslipPDF(Request $request)
    {
        $employeData = $request->validate([
            'month' => 'required',
        ]);
        $config = DB::table('configurations')->where('id', '1')->get();
        $month = date('m', strtotime($request->get('month') . '-01'));
        $errorMonth = date('F-Y', strtotime($request->get('month') . '-01'));
        $year =  date("Y", strtotime($request->get('month') . '-01'));
        $employeeId = $request->get('employee');
        $employeData = DB::table('admins')
                            ->select('admins.id', 'admins.fname', 'admins.lname','admins.salary_amount','admins.salary_type','employees.*')
                            ->join('employees', 'admin_id', '=', 'admins.id')
                            ->whereMonth('employees.currentdate', $month)
                             ->whereYear('employees.currentdate', $year)
                             ->where('employees.admin_id', $employeeId)
                             ->get();
        $attandance = DB::table('employees')
                                ->where('employees.admin_id',$employeeId)
                                ->where('employees.attandance','present')->count();
        $array = (array)$employeData;
        foreach ($array as $newArray) {
            if (!empty($newArray)) {
                $data = ['title' => 'CRM', $employeeId];
                $pdf = PDF::loadView('payslipPDF', $data, compact('employeData', 'employeeId','attandance','config'));
                return $pdf->download('payslip.pdf');
            } else {
                return back()->withError(' Data not found for ' . $errorMonth . '!');
            }
        }
    }

    public function payrollreport()
    {
        $config = DB::table('configurations')->where('id', '1')->get();
        return view('admin.reports.payroll',compact('config'));
    }


    public function payroldlPDF(Request $request)
    {
        $employeData = $request->validate([
            'month' => 'required',
        ]);
        $config = DB::table('configurations')->where('id', '1')->get();
        $config = DB::table('configurations')->where('id', '1')->get();
        $month = date('m', strtotime($request->get('month') . '-01'));
        $errorMonth = date('F-Y', strtotime($request->get('month') . '-01'));
        $year =  date("Y", strtotime($request->get('month') . '-01'));
        // $employeeId = $request->get('employee');
        // $employeData = DB::table('employees')
        //                     ->select('admin_id', 'employees.intime','employees.outtime','employees.currentdate','admins.*')
        //                     ->join('admins', 'admins.id', '=', 'admin_id')
        //                     ->whereMonth('employees.currentdate', $month)
        //                     ->whereYear('employees.currentdate', $year)
        //                     ->get();
        $employeData = DB::table('admins')->where('role','Employee')
        //                     ->whereMonth('employees.currentdate', $month)
        //                     ->whereYear('employees.currentdate', $year)
                                ->get();
        // dd($employeData[0]);

        foreach($employeData as $employe){
            $employeId = $employe->id;

            $attandance[] = DB::table('admins')
                // ->select('admins.id', 'admins.fname', 'admins.lname', 'admins.salary_type', 'employees.*')
                ->select('*')
                ->join('employees', 'admin_id', '=', 'admins.id')
                ->where('admins.id',$employeId)->get();

            $attandance[] = DB::table('employees')
                // ->select('admins.id', 'admins.fname', 'admins.lname', 'admins.salary_type', 'employees.*')
                ->select('*')
                ->join('admins', 'id', '=', 'employees.admin_id')
                ->where('employees.id', $employeId)->get();


        }
                            //->where('employees.attandance', 'present')->count();
        echo "<pre>"; print_r($attandance); die;
        $array = (array)$employeData;
        foreach ($array as $newArray) {
            if (!empty($newArray)) {
                $data = ['title' => 'CRM'];
                $pdf = PDF::loadView('payrollPDF', $data, compact('employeData','attandance','config'));
                return $pdf->download('payroll.pdf');
            } else {
                return back()->withError(' Data not found for ' . $errorMonth . '!');
            }
        }
    }

    public function payrollPDF(Request $request)
    {
        $employeData = $request->validate([
            'month' => 'required',
        ]);
        $config = DB::table('configurations')->where('id', '1')->get();
        $month = date('m', strtotime($request->get('month') . '-01'));
        $errorMonth = date('F-Y', strtotime($request->get('month') . '-01'));
        $year =  date("Y", strtotime($request->get('month') . '-01'));
        $userData['user'] = DB::table('admins')->select('id','fname', 'lname', 'salary_amount')->get();
        foreach($userData['user'] as $emp){
            $userData['attend'][] = DB::table('employees')->where('admin_id', $emp->id)->get();

        }

        echo "<pre>"; print_r($userData); die;
        $array = (array)$employeData;
        foreach ($array as $newArray) {
            if (!empty($newArray)) {
                $data = ['title' => 'CRM'];
                $pdf = PDF::loadView('payrollPDF', $data, compact('employeData', 'attandance','config'));
                return $pdf->download('payroll.pdf');
            } else {
                return back()->withError(' Data not found for ' . $errorMonth . '!');
            }
        }
    }
}

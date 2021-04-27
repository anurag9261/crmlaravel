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
use Illuminate\Support\Facades\Auth;
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
        if (Auth::user()->role == 'Admin') {
            $config = DB::table('configurations')->where('id', '1')->get();
            return view('admin.reports.balance',compact('config'));
        } else {
            return Redirect('/admin');
        }
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
        if (Auth::user()->role == 'Admin') {
            $config = DB::table('configurations')->where('id', '1')->get();
            return view('admin.reports.employee',compact('config'));
        } else {
            return Redirect('/admin');
        }
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
                        ->whereMonth('joining_date', $month)
                        ->whereYear('joining_date', $year)
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
        if (Auth::user()->role == 'Admin') {
            $config = DB::table('configurations')->where('id', '1')->get();
            return view('admin.reports.payroll',compact('config'));
        } else {
            return Redirect('/admin');
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
        $userData = DB::table('admins')->select('id','fname', 'lname', 'salary_amount','salary_type')->where('role','Employee')->get();

        foreach($userData as $emp){
            $userDataAttend = DB::table('employees')->where('admin_id',$emp->id)->where('attandance','present')->get();
            $userPresentDay = count($userDataAttend);
            $dailyHours = array();
            foreach ($userDataAttend as $employee) {
                $inTimeResult = $employee->intime;
                $outTimeResult = $employee->outtime;
                $time1 = new DateTime($inTimeResult);
                $time2 = new DateTime($outTimeResult);
                $interval = $time1->diff($time2);
                $dailyHours[] = $interval->format('%H:%I:%S');

            }
            $time = $dailyHours;
            $total = 0;
            foreach ($time as $element) :
                $temp = explode(":", $element);
                $total += (int) $temp[0] * 3600;
                $total += (int) $temp[1] * 60;
                $total += (int) $temp[2];
            endforeach;
            $totalHours['hours'] = sprintf(
                '%02d:%02d:%02d',
                ($total / 3600),
                ($total / 60 % 60),
                $total % 60
            );

            $arrayEmp = (array)$emp;
            $userPresentDaycount['presentDay'] = $userPresentDay;
            if($arrayEmp['salary_type'] == 2){
                $payAmount['salaryTotal'] = ($userPresentDaycount['presentDay'] * $arrayEmp['salary_amount']) / 30;
            }else{
                $iCostPerHour = $arrayEmp['salary_amount'];
                $timespent = $totalHours['hours'];
                $timeparts = explode(':', $timespent);
                $pay = $timeparts[0] * $iCostPerHour + $timeparts[1] / 60 * $iCostPerHour;
                $payAmount['salaryTotal'] = round($pay);
            }
            $employeSalaryData[] = array_merge($arrayEmp, $totalHours, $userPresentDaycount,$payAmount);
        }

        $array = (array)$employeData;
        foreach ($array as $newArray) {
            if (!empty($newArray)) {
                $data = ['title' => 'CRM'];
                $pdf = PDF::loadView('payrollPDF', $data, compact('employeData','config','employeSalaryData'));
                return $pdf->download('payroll.pdf');
            } else {
                return back()->withError(' Data not found for ' . $errorMonth . '!');
            }
        }
    }
}

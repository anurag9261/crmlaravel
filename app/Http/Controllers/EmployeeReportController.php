<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\EmployeeReport;
use PDF;

class EmployeeReportController extends Controller
{
    public function index(Request $request)
    {
        dd($request->get('month'));
        return view('admin.reports.employee');
    }

    // public function generatePDF(Request $request)

    // {   $profile = new EmployeeReport();
    //     $profile->employee = $request->get('employee');
    //     $profile->month = $request->get('month');
    //     dd($request->get('month'));
    //     $data = ['title' => 'Welcome to CRM'];
    //     $pdf = PDF::loadView('myPDF', $data);
    //     return $pdf->download('employeereport.pdf');
    // }

    public function store(Request $request)

    {
        $profile = new EmployeeReport();
        $profile->employee = $request->get('employee');
        $profile->month = $request->get('month');
        dd($request->get('month'));
        // return $pdf->download('employeereport.pdf');
    }

}

<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $profile['profile'] = DB::table('expenses')->orderBy('created_at','desc')->paginate(5);
        return view('admin.expenses.index',$profile);
    }

    public function getExpenses(Request $request)
    {
        $expenses = Expense::all();
        return datatables()->of($expenses)
            ->addColumn('action', function ($row) {
                $html = '<a href="viewexpense' . $row->id . '" class="btn btn-sm btn-secondary"><i class="far fa-eye"></i></a> ';
                $html .= '<a href="editexpense' . $row->id . '" class="btn btn-sm btn-secondary"><i class="far fa-edit"></i></a> ';
                $html .= '<a href="deleteexpense' . $row->id . '" class="btn btn-sm btn-secondary"><i class="far fa-trash-alt"></i></a>';
                return $html;
            })->toJson();
    }

    public function create()
    {
        return view('admin.expenses.addexpense');
    }

    public function store(Request $request)
    {
        $profile = $request->validate([
            'category' => 'required',
            'entry_date' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'attach_bill' => 'required|image|mimes:jpeg,png,jpg,pdf|max:5120',
        ]);
        $profile=new Expense();
        $profile->category = $request->get('category');
        $profile->entry_date = $request->get('entry_date');
        $profile->amount = $request->get('amount');
        $profile->description = $request->get('description');
        $imageName = time() . '.' . $request->attach_bill->extension();
        $request->attach_bill->move(public_path('bills'), $imageName);
        $profile->attach_bill = $imageName;
        $profile->save();
        return redirect('expenses')->with('message', 'Record saved successfully!');
    }

    public function edit(Expense $expense,$id)
    {
        $profile = Expense::find($id);
        return view('admin.expenses.editexpense',compact('profile'));
    }


    public function update(Request $request, Expense $expense,$id)
    {
        $profile = $request->validate([
            'category' => 'required',
            'entry_date' => 'required',
            'amount' => 'required',
            'description' => 'required',
        ]);
        $profile=Expense::find($id);
        $profile->category = $request->get('category');
        $profile->entry_date = $request->get('entry_date');
        $profile->amount = $request->get('amount');
        $profile->description = $request->get('description');
        if ($request->attach_bill == "") {
            $imageName = $profile->attach_bill;
        } else {
            $imageName = time() . '.' . $request->attach_bill->extension();
            $request->attach_bill->move(public_path('bills'), $imageName);
            $profile->attach_bill = $imageName;
        }
        $profile->save();
        return redirect('expenses')->with('message', 'Record updated successfully!');
    }

    public function destroy(Expense $expense,$id)
    {
        Expense::destroy(array('id',$id));
        return redirect('expenses')->with('error', 'Record deleted successfully!');
    }

    public function view($id){
        $profile = Expense::find($id);
        return view('admin.expenses.viewexpense',compact('profile'));
    }
}

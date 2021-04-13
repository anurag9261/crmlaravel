<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{

    public function index()
    {
        $profile['profile'] = DB::table('expenses')->orderBy('created_at','desc')->paginate(5);
        return view('admin.expenses.index',$profile);
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
        ]);
        $profile=new Expense();
        $profile->category = $request->get('category');
        $profile->entry_date = $request->get('entry_date');
        $profile->amount = $request->get('amount');
        $profile->description = $request->get('description');
        $imageName = time() . '.' . $request->attach_bill->extension();
        $request->attach_bill->move(public_path('images'), $imageName);
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
            $request->attach_bill->move(public_path('images'), $imageName);
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

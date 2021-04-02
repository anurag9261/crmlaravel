<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile['profile'] = DB::table('expenses')->orderBy('created_at','desc')->paginate(5);
        return view('admin.expenses.index',$profile);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.expenses.addexpense');
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
        $profile->save();
        return redirect('expenses')->with('message', 'Record saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense,$id)
    {
        $profile = Expense::find($id);
        return view('admin.expenses.editexpense',compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
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
        $profile->save();
        return redirect('expenses')->with('message', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
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

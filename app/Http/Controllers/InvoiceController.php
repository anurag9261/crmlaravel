<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile['profile'] = DB::table('invoices')->orderBy('created_at','desc')->paginate(5);
        return view('admin.invoices.index',$profile);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoiceDatas = DB::table('invoices')->orderBy('id','desc')->limit(1)->get();
        $invoiceData = (array) $invoiceDatas;
       foreach($invoiceData as $invoiced){
        if(empty($invoiced)){
            $invoiceId = '1';
            
        }else{
            foreach($invoiceDatas as $invData){
                $oldInvoiceId = $invData->id;
                $invoiceId = $oldInvoiceId + 1;
            }
        }
       
    }
        $mytime = Carbon\Carbon::now();
        $currentDate =  $mytime->toDateString();
        return view('admin.invoices.addinvoice',compact('invoiceId','currentDate'));
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
            'title' => 'required',
            'billto' => 'required',
            'shipto' => 'required',
            'currentdate' => 'required',
            'duedate' => 'required',
            'sub_total' => 'required',
            'tax_percentage' => 'required',
            'tax_amount' => 'required',
            'total_amount' =>'required'
        ]);
        $product = $request->validate([
            'product' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'total' => 'required',
        ]);
            $profile=new Invoice();
            $profile->title = $request->get('title');
            $profile->bill_to = $request->get('billto');
            $profile->ship_to = $request->get('shipto');
            $profile->current_date = $request->get('currentdate')->date_format;
            $profile->due_date = $request->get('duedate');
            $profile->total = 0;
            // $profile->total = $request->get('total');
            $profile->sub_total = $request->get('sub_total');
            $profile->tax_percentage = $request->get('tax_percentage');
            $profile->tax_amount = $request->get('tax_amount');
            $profile->total_amount = $request->get('total_amount');
            // echo "<pre>";print_r($profile);die;
            $profile->save();

            $count = count($request->get('product'));
            for ($i = 0; $i < $count; $i++) {
                $product = new Product();
                $product->invoice_id = $request->get('invoice_no');
                $product->product = $request->get('product')[$i];
                $product->qty = $request->get('qty')[$i];
                $product->price = $request->get('price')[$i];
                $product->total = $request->get('total')[$i];
                $product->save();
            }
         //echo'<pre>';print_r($product);die;
         return redirect('invoices')->with('message', 'Invoice added successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function view($id){
        $profile = Invoice::find($id);
        $pr = Product::find($id);
        return view('admin.invoices.viewinvoice',compact('profile','pr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice,$id)
    {
        $profile = Invoice::find($id);
        $products = DB::table('products')
            ->where('invoice_id', $id)
            ->get();
        return view('admin.invoices.editinvoice', compact('profile','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice,$id)
    {
        $profile = $request->validate([
            'title' => 'required',
            'billto' => 'required',
            'shipto' => 'required',
            'currentdate' => 'required',
            'duedate' => 'required',
            'sub_total' => 'required',
            'tax_percentage' => 'required',
            'tax_amount' => 'required',
            'total_amount' =>'required'
        ]);
        $product = $request->validate([
            'product' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'total' => 'required',
        ]);
            $profile=Invoice::find($id);
            $profile->title = $request->get('title');
            $profile->bill_to = $request->get('billto');
            $profile->ship_to = $request->get('shipto');
            $profile->current_date = $request->get('currentdate');
            $profile->due_date = $request->get('duedate');
            // $profile->total = 0;
            $profile->sub_total = $request->get('sub_total');
            $profile->tax_percentage = $request->get('tax_percentage');
            $profile->tax_amount = $request->get('tax_amount');
            $profile->total_amount = $request->get('total_amount');
            $profile->save();
            
            
            $count = count($request->get('product'));

            for ($i = 0; $i < $count; $i++) {
                // echo'<pre>';print_r($product->id);die;
                $product = Product::find($request->get('id')[$i]);
                if ($product == null) {
                    $productP = new Product();
                    $productP->invoice_id = $request->get('invoice_no');
                    $productP->product = $request->get('product')[$i];
                    $productP->qty = $request->get('qty')[$i];
                    $productP->price = $request->get('price')[$i];
                    $productP->total = $request->get('total')[$i];
                    $productP->save();
                } else {
                    $productU  = Product::find($request->get('id')[$i]);
                    $productU->invoice_id = $request->get('invoice_no');
                    $productU->product = $request->get('product')[$i];
                    $productU->qty = $request->get('qty')[$i];
                    $productU->price = $request->get('price')[$i];
                    $productU->total = $request->get('total')[$i];
                    $productU->save();

                    
                }
            }
            return redirect('invoices')->with('message', 'Invoice updated successfully!');
    //echo'<pre>';print_r($product);die;
            
            
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     * 
     */
 
    
    public function destroy(Invoice $invoice,$id)
    {
        Invoice::destroy(array('id',$id));
        DB::table("products")->where("invoice_id", $id)->delete();
        return redirect('invoices')->with('error', 'Invoice deleted successfully!');
    }

}
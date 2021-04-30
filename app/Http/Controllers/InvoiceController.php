<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon;
use PDF;

class InvoiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $profile = DB::table('invoices');
        $config = DB::table('configurations')->where('id', '1')->get();
        return view('admin.invoices.index', compact('profile', 'config'));
    }

    public function getInvoices(Request $request)
    {
        $invoices = Invoice::all();
        return datatables()->of($invoices)
            ->addColumn('action', function ($row) {
                $html = '<a href="viewinvoice' . $row->id . '" class="btn btn-sm btn-secondary"><i class="far fa-eye"></i></a> ';
                $html .= '<a href="editinvoice' . $row->id . '" class="btn btn-sm btn-secondary"><i class="far fa-edit"></i></a> ';
                $html .= '<a href="deleteinvoice' . $row->id . '" class="btn btn-sm btn-secondary" onclick="myFunction()"><i class="far fa-trash-alt"></i></a>';
                return $html;
            })->toJson();
    }


    public function create()
    {
        $invoiceDatas = DB::table('invoices')->orderBy('id', 'desc')->limit(1)->get();
        $customers = DB::table('customers')->get();
        $config = DB::table('configurations')->where('id', '1')->get();
        $invoiceData = (array) $invoiceDatas;
        foreach ($invoiceData as $invoiced) {
            if (empty($invoiced)) {
                $invoiceId = '1';
            } else {
                foreach ($invoiceDatas as $invData) {
                    $oldInvoiceId = $invData->id;
                    $invoiceId = $oldInvoiceId + 1;
                }
            }
        }
        $mytime = Carbon\Carbon::now();
        $currentDate =  $mytime->toDateString();
        return view('admin.invoices.addinvoice', compact('invoiceId', 'currentDate', 'customers', 'config'));
    }


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
            'total_amount' => 'required'
        ]);
        $product = $request->validate([
            'product' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'total' => 'required',
        ]);
        $profile = new Invoice();
        $profile->title = $request->get('title');
        $profile->bill_to = $request->get('billto');
        $profile->ship_to = $request->get('shipto');
        $profile->current_date = $request->get('currentdate');
        $profile->due_date = $request->get('duedate');
        $profile->total = 0;
        $profile->sub_total = $request->get('sub_total');
        $profile->tax_percentage = $request->get('tax_percentage');
        $profile->tax_amount = $request->get('tax_amount');
        $profile->total_amount = $request->get('total_amount');
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
        return redirect('invoices')->with('message', 'Invoice added successfully!');
    }

    public function view($id)
    {
        $profile = Invoice::find($id);
        $product = Product::get()->where('invoice_id', $id);
        $config = DB::table('configurations')->where('id', '1')->get();
        return view('admin.invoices.viewinvoice', compact('profile', 'product', 'config'));
    }

    public function Invoiceprint(Request $request, $id)
    {

        $invoice = Invoice::find($id);
        $config = DB::table('configurations')->where('id', '1')->get();
        $productData =  DB::table('products')
                            ->where('invoice_id', $id)
                                ->get();
        $data = ['title' => 'CRM'];
        $pdf = PDF::loadView('invoicereport', $data, compact('invoice', 'productData', 'config'));
        return $pdf->download('invoicereport.pdf');
    }


    public function edit(Invoice $invoice, $id)
    {
        $profile = Invoice::find($id);
        $customers = DB::table('customers')->get();
        $products = DB::table('products')->where('invoice_id', $id)->get();
        $config = DB::table('configurations')->where('id', '1')->get();
        return view('admin.invoices.editinvoice', compact('profile', 'products', 'customers', 'config'));
    }

    public function update(Request $request, Invoice $invoice, $id)
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
            'total_amount' => 'required',
            'status' => 'required',
        ]);
        $product = $request->validate([
            'product' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'total' => 'required',
        ]);
        $profile = Invoice::find($id);
        $profile->title = $request->get('title');
        $profile->bill_to = $request->get('billto');
        $profile->ship_to = $request->get('shipto');
        $profile->current_date = $request->get('currentdate');
        $profile->due_date = $request->get('duedate');
        $profile->sub_total = $request->get('sub_total');
        $profile->tax_percentage = $request->get('tax_percentage');
        $profile->tax_amount = $request->get('tax_amount');
        $profile->total_amount = $request->get('total_amount');
        $profile->status = $request->get('status');
        $profile->save();

        $count = count($request->get('product'));
        for ($i = 0; $i < $count; $i++) {
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
    }

    public function destroy(Invoice $invoice, $id)
    {
        Invoice::destroy(array('id', $id));
        DB::table("products")->where("invoice_id", $id)->delete();
        return redirect('invoices')->with('error', 'Invoice deleted successfully!');
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete($id);
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }
    public function deleteAll($id)
    {
        DB::table("products")->delete($id);
        return back();
    }
}

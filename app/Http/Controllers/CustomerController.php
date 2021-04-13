<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Validator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Seesion;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
class CustomerController extends Controller
{

    public function index()
    {
        $profile['profile'] = DB::table('customers')->orderBy('created_at','desc')->paginate(5);
        return view('admin.customers.index',$profile);
    }

    public function getCustomers(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $rowperpage = $request->get('length');
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');
        $columnIndex = $columnIndex_arr[0]['column'];
        $columnName = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];
        $searchValue = $search_arr['value'];

        //Total Records
        $totalRecords = Customer::select('count(*) as allcount')->count();

        //Records with search Filter
        $totalRecordswithFilter = Customer::select('count(*) as allcount')
                                        ->where('fname','like','%'.$searchValue.'%')
                                        ->orWhere('lname', 'like', '%' . $searchValue . '%')
                                        ->orWhere('email', 'like', '%' . $searchValue . '%')
                                        ->orwhere('mobno', 'like', '%' . $searchValue . '%')
                                        ->orwhere('status', 'like', '%' . $searchValue . '%')
                                        ->count();

        //Filter Records
        $records = Customer::orderby($columnName,$columnSortOrder)
                            ->where('customers.fname','like','%'.$searchValue.'%')
                            ->orWhere('customers.lname', 'like', '%' . $searchValue . '%')
                            ->orWhere('customers.email', 'like', '%' . $searchValue . '%')
                            ->orWhere('customers.mobno', 'like', '%' . $searchValue . '%')
                            ->orWhere('customers.status', 'like', '%' . $searchValue . '%')
                            ->select('customers.*')
                            ->skip($start)
                            ->take($rowperpage)
                            ->get();

        $data_arr = array();
        foreach($records as $record){
            $id = $record->id;
            $fname = $record->fname;
            $lname = $record->lname;
            $email = $record->email;
            $mobno = $record->mobno;
            $image = $record->image;
            $status = $record->status;
            $data_arr[] =array(
                "id"=>$id,
                "fname"=>$fname,
                "lname"=>$lname,
                "email"=>$email,
                "mobno"=>$mobno,
                "image"=>$image,
                "status"=>$status
            );
        }

        $response = array(
            "draw"=>intval($draw),
            "iTotalRecords"=>$totalRecords,
            "iTotalDisplayRecords"=>$totalRecordswithFilter,
            "aaData"=>$data_arr
        );
        echo json_encode($response);
        exit;
    }

    public function create()
    {
        return view('admin.customers.addcustomer');
    }

    public function store(Request $request)
    {

        $profile = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'mobno' => 'required',
            'email' => 'required',
            'address' => 'required',
            'image' => 'required',
            'status' => 'required',
            'password' => 'required',
        ]);
        $profile=new Customer();
        $profile->fname = $request->get('fname');
        $profile->lname = $request->get('lname');
        $profile->mobno = $request->get('mobno');
        $profile->email = $request->get('email');
        $profile->address = $request->get('address');
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $profile->image = $imageName;
        $profile->status = $request->get('status');
        $profile->password = $request->get('password');
        $profile->save();
        return redirect('customers')->with('message', 'Record saved successfully!');
    }

    public function edit(Customer $customer,$id)
    {
        $profile = Customer::find($id);
        return view('admin.customers.editcustomer',compact('profile'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'mobno' => 'required',
            'email' => 'required',
            'address' => 'required',
            // 'image' => 'required',
            'status' => 'required',
            //'password' => 'required',
        ]);
        $profile=Customer::find($id);
        if( $request->image == ""){
            $imageName = $profile->image;
        }else{
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $profile->image = $imageName;
        }
        $profile->fname = $request->get('fname');
        $profile->lname = $request->get('lname');
        $profile->mobno = $request->get('mobno');
        $profile->email = $request->get('email');
        $profile->address = $request->get('address');
        $profile->status = $request->get('status');
        $profile->save();
        return redirect('customers')->with('message', 'Record updated successfully!');
    }

    public function destroy(Customer $customer,$id)
    {
        Customer::destroy(array('id',$id));
        return redirect('customers')->with('error', 'Record deleted successfully!');
    }

    public function view(Customer $customer,$id){
        $profile = Customer::find($id);
        return view('admin.customers.viewcustomer',compact('profile'));
    }

    public function getEmployees(Request $request){

        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');
        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Customer::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Customer::select('count(*) as allcount')->where('fname', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Customer::orderBy($columnName,$columnSortOrder)
                            ->where('customer.fname', 'like', '%' .$searchValue . '%')
                            ->select('customer.*')
                            ->skip($start)
                            ->take($rowperpage)
                            ->get();

        $data_arr = array();

        foreach($records as $record){
           $id = $record->id;
           $fname = $record->fname;
           $lname = $record->lname;
           $email = $record->email;

           $data_arr[] = array(
             "id" => $id,
             "fname" => $fname,
             "name" => $lname,
             "email" => $email
           );
        }

        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
      }
}


@extends('admin.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Invoice</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Invoice Management</li>
                        <li class="breadcrumb-item active">Edit Invoice</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-secondary" style="float:right"><a href="{{route('admin.invoices')}}"
                                style="color:white"><i class="fas fa-arrow-left"></i> Back</a></button>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <!-- Left col -->
        <section class="col-lg-11 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <form action="{{route('admin.updateinvoice',[$profile->id])}}" method="post">
                            @csrf
                            <div class="row clearfix" style="margin-top:20px">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-2" style="font-size:30px;" >
                                    INVOICE
                                </div>
                            </div>
                            <div class="row clearfix" style="margin-top:20px">
                                <div class="col-md-6">
                                    <label for="title">Title</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                        placeholder="who is this invoice from?(required)" name="title">{{$profile->title}}</textarea>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="input-group col-md-2">
                                    <input type="text" class="form-control" name="invoice_no" value="{{$profile->id}}" readonly>
                                </div>
                            </div>
                            <div class="row clearfix" style="margin-top:20px">
                                <div class="col-md-4">
                                    <label for="billto">Bill To</label>
                                    <select class="form-control" name="billto">
                                        @foreach($customers as $customer)
                                        <option>{{$customer->fname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                <label for="currentdate">Current Date</label>
                                <input type="text" id="datepicker5" name="currentdate" class="form-control"
                                     value="{{$profile->current_date}}">
                                </div>
                            </div>
                            <div class="row clearfix" style="margin-top:20px">
                                <div class="col-md-4">
                                    <label for="shipto">Ship To</label>
                                    <input class="form-control" rows="2"
                                         name="shipto" value="{{$profile->ship_to}}">
                                </div>
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                    <label for="duedate">Due Date</label>
                                    <input type="text" name="duedate" id="datepicker6" class="form-control" value="{{$profile->due_date}}">
                                </div>
                                </div>
                            </div>
                            <br>
                            <div class="row clearfix">
                                <table class="table table-border table-hover" id="tab1_logic">
                                    <thead class="table table-inverse">
                                        <tr>
                                            <th class="text-center"> # </th>
                                            <th class="text-center">Id</th>
                                            
                                            <th class="text-center"> Product </th>
                                            <th class="text-center"> Qty </th>
                                            <th class="text-center"> Price </th>
                                            <th class="text-center"> Total </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $pr)
                                        <tr id='editr0'>
                                            <td>1</td>
                                            <td><input type="text" name='id[]' value="{{$pr->id}}"
                                                    class="form-control"/></td>
                                           
                                            <td><input type="text" name='product[]' value="{{$pr->product}}"
                                                    class="form-control" /></td>
                                            <td><input type="number" name='qty[]' value="{{$pr->qty}}"
                                                    class="form-control qty" step="0" min="0" /></td>
                                            <td><input type="number" name='price[]' value="{{$pr->price}}"
                                                    class="form-control price" step="0.00" min="0" /></td>
                                            <td><input type="number" name='total[]' value="{{$pr->total}}"
                                                    class="form-control total" readonly /></td>
                                      
                                        </tr>
                                    @endforeach
                                    <tr id="editr1"></tr>
                                    <tr id="editr2"></tr>
                                    <tr id="editr3"></tr>
                                    <tr id="editr4"></tr>
                                    <tr id="editr5"></tr>
                                   
                                    </tbody>
                                </table>

                            </div>
                            <div class="row clearfix">
                                <div class="col-md-2">
                                    <button id="edit_row" type="button"  class="btn btn-secondary pull-left">Add</button>
                                </div>
                                <div class="col-md-9"></div>
                                <div>
                                    <button id='delete_row1' href="" type="button" class="pull-right btn btn-secondary">Delete</button>
                                </div>
                            </div>
                            <div class="row clearfix" style="margin-top:20px">
                                <div class="col-md-4">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="Pending" {{ ($profile->status) == 'Pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="Paid" {{ ($profile->status) == 'Paid' ? 'selected' : '' }}>
                                        Paid</option>
                                </select>
                                </div>
                            </div>
                            <div class="row clearfix" style="margin-top:20px">
                                <div class="col-md-4"></div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <table class="table table-hover" id="tab1_logic_total">
                                        <tbody>
                                            <tr>
                                                <th class="text-center">Sub Total</th>
                                                <td class="text-center"><input type="number" name='sub_total'
                                                        value="{{$profile->sub_total}}" class="form-control" id="sub_total1"
                                                        readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Tax</th>
                                                <td class="text-center">
                                                    <div class="input-group mb-2 mb-sm-0">
                                                        <input type="number" class="form-control" name="tax_percentage" value="{{$profile->tax_percentage}}"
                                                            id="tax1" placeholder="0">
                                                        <div class="input-group-addon">%</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Tax Amount</th>
                                                <td class="text-center"><input type="number" name='tax_amount'
                                                        id="tax_amount1" value="{{$profile->tax_amount}}" class="form-control"
                                                        readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Grand Total</th>
                                                <td class="text-center"><input type="number" name='total_amount'
                                                        id="total_amount1" value="{{$profile->total_amount}}" class="form-control"
                                                        readonly /></td>
                                            </tr>
                                        </tbody>
                                    </table> 
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-10"></div>
                                <div class="col-md-2">
                                <button type="submit" class="btn btn-secondary">Submit</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
        </section>
    </div>
</div>
@endsection
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(function() {
    $("#datepicker5").datepicker({
        dateFormat: "yy-mm-dd"
    });
});
</script>
<script>
$(function() {
    $("#datepicker6").datepicker({
        dateFormat: "yy-mm-dd"
    });
});
</script>

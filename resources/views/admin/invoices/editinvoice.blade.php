@extends('admin.master')
@push('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add Invoice</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Invoice Management</li>
                        <li class="breadcrumb-item active">Add Invoice</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-secondary" style="float:right"><a href="{{route('admin.invoices')}}" style="color:white"><i class="fas fa-arrow-left"></i> Back</a></button>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->
    <div class="content">
        <section class="col-lg-11 connectedSortable">
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
                                <div class="col-md-2" style="font-size:30px;">
                                    INVOICE
                                </div>
                            </div>
                            <div class="row clearfix" style="margin-top:20px">
                                <div class="col-md-6">
                                    <label for="title">Title</label>
                                    <textarea class="form-control  @error('title') is-invalid @enderror" id="" rows="3" placeholder="who is this invoice from?(required)" name="title"></textarea>
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4"></div>
                                <div class="input-group col-md-2">
                                    <input type="text" class="form-control" name="invoice_no" value="" readonly>

                                </div>
                            </div>
                            <div class="row clearfix" style="margin-top:20px">
                                <div class="col-md-4">
                                    <label for="billto">Bill To</label>
                                    <select class="form-control  @error('bill_to') is-invalid @enderror" name="billto">
                                        @foreach($customers as $customer)
                                        <option>{{$customer->fname}}</option>
                                        @endforeach
                                    </select>
                                    @error('bill_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                    <label for="currentdate">Current Date</label>
                                    <input type="text" id="datepicker" name="currentdate" class="form-control" value="">
                                </div>
                            </div>
                            <div class="row clearfix" style="margin-top:20px">
                                <div class="col-md-4">
                                    <label for="shipto">Ship To</label>
                                    <input class="form-control @error('shipto') is-invalid @enderror" placeholder="who is this invoice to?(required)" name="shipto">
                                    @error('shipto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                    <label for="duedate">Due Date</label>
                                    <input type="text" name="duedate" id="datepicker1" class="form-control @error('duedate') is-invalid @enderror" placeholder="yyyy-mm-dd">
                                    @error('duedate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row clearfix">
                                <table class="table table-border table-hover" id="tab_logic">
                                    <thead>
                                        <tr>
                                            <th class="text-center"> # </th>
                                            <th class="text-center"> Product </th>
                                            <th class="text-center"> Qty </th>
                                            <th class="text-center"> Price </th>
                                            <th class="text-center"> Total </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $key=>$pr)
                                        <tr id='addr0'>
                                            <td>1</td>
                                            <td><input type="text" name='product[]' placeholder='Enter Product Name' class="form-control @error('product[]') is-invalid @enderror" />
                                            </td>
                                            <td><input type="number" name='qty[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0" /></td>
                                            <td><input type="number" name='price[]' placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0" /></td>
                                            <td><input type="number" name='total[]' placeholder='0.00' class="form-control total" readonly /></td>
                                        </tr>
                                        @endforeach
                                        <tr id='addr1'></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-2">
                                    <button id="add_row" type="button" class="btn btn-secondary pull-left">Add</button>
                                </div>
                                <div class="col-md-9"></div>
                                <div>
                                    <button id='delete_row' type="button" class="pull-right btn btn-secondary">Delete</button>
                                </div>
                            </div>
                            <div class="row clearfix" style="margin-top:20px">
                                <div class="col-md-4"></div>
                                <div class="col-md-4"></div>
                                <div class="pull-right col-md-4">
                                    <table class="table table-border table-hover" id="tab_logic_total">
                                        <tbody>
                                            <tr>
                                                <th class="text-center">Sub Total</th>
                                                <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control @error('sub_total') is-invalid @enderror" id="sub_total" readonly />
                                                    @error('sub_total')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Tax</th>
                                                <td class="text-center">
                                                    <div class="input-group mb-2 mb-sm-0">
                                                        <input type="number" class="form-control @error('tax_percentage') is-invalid @enderror" name="tax_percentage" id="tax" placeholder="0">
                                                        <div class="input-group-addon">%</div>
                                                        @error('tax_percentage')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Tax Amount</th>
                                                <td class="text-center"><input type="number" name='tax_amount' id="tax_amount" placeholder='0.00' class="form-control @error('tax_amount') is-invalid @enderror" readonly />
                                                    @error('tax_amount')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Grand Total</th>
                                                <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control form-control @error('total_amount') is-invalid @enderror" readonly />
                                                    @error('total_amount')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </td>
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
            </div>
        </section>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        var i = 1;
        $("#add_row").click(function() {
            b = i - 1;
            $('#addr' + i).html($('#addr' + b).html()).find('td:first-child').html(i + 1);
            $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
            i++;
        });
        $("#delete_row").click(function() {
            if (i > 1) {
                $("#addr" + (i - 1)).html('');
                i--;
            }
            calc();
        });

        $('#tab_logic tbody').on('keyup change', function() {
            calc();
        });
        $('#tax').on('keyup change', function() {
            calc_total();
        });
    });

    function calc() {
        $('#tab_logic tbody tr').each(function(i, element) {
            var html = $(this).html();
            if (html != '') {
                var qty = $(this).find('.qty').val();
                var price = $(this).find('.price').val();
                $(this).find('.total').val(qty * price);
                calc_total();
            }
        });
    }

    function calc_total() {
        total = 0;
        $('.total').each(function() {
            total += parseInt($(this).val());
        });
        $('#sub_total').val(total.toFixed(2));
        tax_sum = total / 100 * $('#tax').val();
        $('#tax_amount').val(tax_sum.toFixed(2));
        $('#total_amount').val((tax_sum + total).toFixed(2));
    }
</Script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        $("#datepicker").datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
</script>
<script>
    $(function() {
        $("#datepicker1").datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
</script>
@endpush

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
                    <h1 class="m-0 text-dark">Edit Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Invoice Management</li>
                        <li class="breadcrumb-item active">Edit Invoice</li>
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
                                    <textarea class="form-control  @error('title') is-invalid @enderror" id="" rows="3" placeholder="who is this invoice from?(required)" name="title">{{ $profile->title }}</textarea>
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4"></div>
                                <div class="input-group col-md-2">
                                    <input type="text" class="form-control" name="invoice_no" value="{{ $profile->id}}" readonly>

                                </div>
                            </div>
                            <div class="row clearfix" style="margin-top:20px">
                                <div class="col-md-4">
                                    <label for="billto">Bill To</label>
                                    <select class="form-control  @error('bill_to') is-invalid @enderror" name="billto">
                                        @foreach($customers as $customer)
                                        <option>{{$customer->fname}} {{ $customer->lname }}</option>
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
                                    <input type="text" id="datepicker" name="currentdate" class="form-control" value="{{ $profile->current_date }}">
                                </div>
                            </div>
                            <div class="row clearfix" style="margin-top:20px">
                                <div class="col-md-4">
                                    <label for="shipto">Ship To</label>
                                    <input class="form-control @error('shipto') is-invalid @enderror" placeholder="who is this invoice to?(required)" name="shipto" value="{{ $profile->ship_to }}">
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
                                    <input type="text" name="duedate" id="datepicker1" class="form-control @error('duedate') is-invalid @enderror" placeholder="yyyy-mm-dd" value="{{ $profile->due_date }}">
                                    @error('duedate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="row clearfix">
                                <table id="tab_logic" class="table table-border table-hover table order-list">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Product</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $key=>$pr)
                                        <tr id="tr_{{$pr->id}}">
                                            <td hidden><input type="text" name='id[]' value="{{$pr->id}}" class="form-control" hidden/></td>
                                            <td hidden><input type="text" name='invoice_id[]' value="{{$pr->invoice_id}}" class="form-control" hidden/></td>
                                            <td>
                                                <input type="text" name="product[]" placeholder="Enter Product Name" class="form-control" value="{{ $pr->product }}" />
                                            </td>
                                            <td>
                                                <input type="text" name="qty[]" placeholder="Enter Qty" class="form-control qty" value="{{ $pr->qty }}" />
                                            </td>
                                            <td>
                                                <input type="text" name="price[]" placeholder="Enter Price" class="form-control price" value="{{ $pr->price }}" />
                                            </td>
                                            <td>
                                                <input type="text" name="total[]" placeholder="Enter Total" class="form-control total" value="{{ $pr->total }}" readonly/>
                                            </td>
                                            @if($pr->id != '')
                                            <td>
                                                <a href="{{ url('deleteproduct',$pr->id) }}" class="btn btn-secondary btn-sm" data-tr="tr_{{$pr->id}}"
                                                    data-toggle="confirmation" data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                                                    data-btn-ok-class="btn btn-sm btn-danger" data-btn-cancel-label="Cancel"
                                                    data-btn-cancel-icon="fa fa-chevron-circle-left" data-btn-cancel-class="btn btn-sm btn-default"
                                                    data-title="Are you sure you want to delete ?" data-placement="left" data-singleton="true">
                                                    Delete
                                                </a>
                                            </td>
                                            @else
                                            <td>
                                                <a class="deleteRow"></a>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-2">
                                    <input type="button" class="btn btn-secondary" id="addrow" value="Add Row" /></button>
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
                                <div class="pull-right col-md-4">
                                    <table class="table table-border table-hover" id="tab_logic_total">
                                        <tbody>
                                            <tr>
                                                <th class="text-center">Sub Total</th>
                                                <td class="text-center">
                                                    <input type="number" name='sub_total' placeholder='0.00' class="form-control @error('sub_total') is-invalid @enderror" id="sub_total1" value="{{ $profile->sub_total }}" readonly />
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
                                                    <input type="number" class="form-control @error('tax_percentage') is-invalid @enderror" name="tax_percentage" id="tax1" placeholder="0" value="{{ $profile->tax_percentage }}">
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
                                                <td class="text-center">

                                                    <input type="number" name='tax_amount' id="tax_amount1" placeholder='0.00' class="form-control @error('tax_amount') is-invalid @enderror" value="{{ $profile->tax_amount }}" readonly />
                                                    @error('tax_amount')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror

                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Grand Total</th>
                                                <td class="text-center">
                                                    <input type="number" name='total_amount' id="total_amount1" placeholder='0.00' class="form-control form-control @error('total_amount') is-invalid @enderror" value="{{ $profile->total_amount }}" readonly />
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
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
$(document).ready(function () {
    var counter = 0;

    $("#addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td hidden><input type="hidden" class="form-control id" name="id[]' + counter + '" /></td>';
        cols += '<td hidden><input type="hidden" class="form-control invoice_id" name="invoice_id[]' + counter + '" /></td>';
        cols += '<td><input type="text" class="form-control product" name="product[]' + counter + '" /></td>';
        cols += '<td><input type="text" class="form-control qty" name="qty[]' + counter + '" /></td>';
        cols += '<td><input type="text" class="form-control price" name="price[]' + counter + '" /></td>';
        cols += '<td><input type="text" class="form-control total" name="total[]' + counter + '"  readonly/></td>';

        cols += '<td><input type="button" class="ibtnDel btn btn-sm btn-secondary" value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
        counter++;
    });

    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();
        counter -= 1;
        calc();
    });

    $('#tab_logic tbody').on('keyup change', function() {
        calc();
    });
    $('#tax1').on('keyup change', function() {
        calc_total();
    });

});
function calc()
{
    $('#tab_logic tbody tr').each(function(i, element) {
        var html = $(this).html();
        if(html!='')
        {
            var qty = $(this).find('.qty').val();
            var price = $(this).find('.price').val();
            $(this).find('.total').val(qty*price);
            calc_total();
        }
    });
}

function calc_total() {
    total = 0;
    $('.total').each(function() {
        total += parseInt($(this).val());
    });
    $('#sub_total1').val(total.toFixed(2));
    tax_sum = total / 100 * $('#tax1').val();
    $('#tax_amount1').val(tax_sum.toFixed(2));
    $('#total_amount1').val((tax_sum + total).toFixed(2));
}
</script>
<script>
    $(".deleteProduct").click(function(){
        var id = $(this).data("id");
        var token = $(this).data("token");
        $.ajax(
        {
        url: "udpdateinvoice"+$pr->id,
        type: 'PUT',
        dataType: "JSON",
        data: {
        "id": id,
        "_method": 'DELETE',
        "_token": token,
        },
        success: function ()
        {
            console.log("it Work");
        }
        calc();
    });
        console.log("It failed");
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
@endpush

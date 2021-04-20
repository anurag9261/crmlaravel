@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Invoice Management</li>
                        <li class="breadcrumb-item active">View Invoice</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-secondary" style="float:right"><a href="{{route('admin.invoices')}}"
                                style="color:white"><i class="fas fa-arrow-left"></i> Back</a></button>

                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->
    <div class="content">
        <!-- Left col -->
        <section class="col-lg-9 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Id</th>
                            <td>{{$profile->id}}</td>

                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{$profile->title}}</td>
                        </tr>
                        <tr>
                            <th>Current Date</th>
                            <td>{{$profile->current_date}}</td>
                        </tr>
                        <tr>
                            <th>Due Date</th>
                            <td>{{$profile->due_date}}</td>
                        </tr>
                        <tr>
                            <th>Bill To</th>
                            <td>{{$profile->bill_to}}</td>
                        </tr>
                        <tr>
                            <th>Ship To</th>
                            <td>{{$profile->ship_to}}</td>
                        </tr>
                        <tr>
                            <th>Sub Total</th>
                            <td>{{$profile->sub_total}}</td>
                        </tr>
                        <tr>
                            <th>Tax Percentage</th>
                            <td>{{$profile->tax_percentage}}</td>
                        </tr>
                        <tr>
                            <th>Tax</th>
                            <td>{{$profile->tax_amount}}</td>
                        </tr>
                        <tr>
                            <th>Grand Total</th>
                            <td>{{$profile->total_amount}}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{$profile->created_at}}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{$profile->updated_at}}</td>
                        </tr>
                    </table>
                    <br>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                        @foreach ($product as $data)
                            <tr>
                                <td>{{ $data->product }}</td>
                                <td>{{ $data->qty }}</td>
                                <td>{{ $data->price }}</td>
                                <td>{{ $data->total}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

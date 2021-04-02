@extends('admin.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View Invoice</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">View Invoice</li>
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
        <section class="col-lg-9 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        
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
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
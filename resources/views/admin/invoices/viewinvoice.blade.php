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
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.invoices') }}">Invoice Management</a></li>
                        <li class="breadcrumb-item active">View Invoice</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <button class="btn btn-secondary" style="float:right"><a href="invoicePrint{{$profile->id}}" style="color:white">Download</a></button>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-secondary" style="float:right"><a href="{{route('admin.invoices')}}"
                                style="color:white"><i class="fas fa-arrow-left"></i> Back</a></button>

                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <section class="col-lg-9 connectedSortable">
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
                            <th>Sub Total(CAD)</th>
                            <td>{{$profile->sub_total}}</td>
                        </tr>
                        <tr>
                            <th>Tax Percentage(%)</th>
                            <td>{{$profile->tax_percentage}}</td>
                        </tr>
                        <tr>
                            <th>Tax(CAD)</th>
                            <td>{{$profile->tax_amount}}</td>
                        </tr>
                        <tr>
                            <th>Grand Total(CAD)</th>
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
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th style="text-align: right">Price(CAD)</th>
                            <th style="text-align: right">Total(CAD)</th>
                        </tr>
                        @foreach ($product as $data)
                            <tr>
                                <td>{{ $data->product }}</td>
                                <td>{{ $data->qty }}</td>
                                <td style="text-align: right">{{ $data->price }}</td>
                                <td style="text-align: right">{{ $data->total}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@extends('admin.master')
@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Invoice Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Invoice Report</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        {{--  <button class="btn btn-secondary" style="float:right"><a href="{{route('admin.roles')}}"
                        style="color:white"><i class="fas fa-arrow-left"></i> Back</a></button> --}}
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <!-- Left col -->
        <section class="col-lg-9 connectedSortable">
            @if (session('error'))
            <div class="alert alert-warning">{{ session('error') }}</div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form method="get" action="{{ route('admin.invoicereport') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <label for="customer">Select Customer</label>
                                <select class="form-control @error('customer') is-invalid @enderror" name="customer">
                                    <option value="">Select Customer</option>
                                    @foreach($customer as $title)
                                    <option>{{$title->fname}}</option>
                                    @endforeach
                                </select>
                                @error('customer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="status">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status">
                                    <option value="">Select Status</option>
                                    <option>Paid</option>
                                    <option>Pending</option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="month">Select Month</label>
                                <input type="text" class="form-control @error('month') is-invalid @enderror" name="month" id="datepicker"
                                    placeholder="Select Month"/>
                                @error('month')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <button type="submit" class="btn btn-secondary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <h4 style="tex-align:center">Invoices</h4>
                    @csrf
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Bill To</th>
                            <th>Due Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Print</th>
                        </tr>
                        <?php //echo "<pre>"; print_r($dataTable); die; ?>
                        @if($dataTable != "no_data_found")
                        <?php //echo "<pre>"; print_r($dataTable); die; ?>
                        @foreach ($dataTable as $data)
                            <tr>
                                <td>{{ $data->id}}</td>
                                <td>{{ $data->title }}</td>
                                <td>{{ $data->bill_to }}</td>
                                <td>{{ $data->due_date }}</td>
                                <td>{{ $data->total }}</td>
                                <td>{{ $data->status }}</td>
                                <td><button class="btn btn-secondary" type="submit"><a href="invoicepdfprint{{$data->id}}" style="color:white"><i class="fas fa-print"></i></a></button></td>
                            </tr>
                        @endforeach
                        @else
                        <tr>
                           <td colspan="7" style="text-align:center">No Records Found!</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $("#datepicker").datepicker( {
    format: "yyyy-MM",
    startView: "months",
    minViewMode: "months"
    });
</script>
@endpush

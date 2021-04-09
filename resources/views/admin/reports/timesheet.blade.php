@extends('admin.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Timesheet Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Timesheet Report</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        {{--  <button class="btn btn-secondary" style="float:right"><a href="{{route('admin.roles')}}"
                                style="color:white"><i class="fas fa-arrow-left"></i> Back</a></button>  --}}
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
                    <form method="post" action="{{ route('report.timesheet') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <label for="employee">Select Employee</label>
                            <select class="form-control @error('employee') is-invalid @enderror" name="employee">
                                <option>Select Employee</option>
                                @foreach($employee as $profile)
                                    <option>{{ $profile->fname }}</option>
                                @endforeach
                            </select>
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-5">
                            <label for="month">Select Month</label>
                            <select class="form-control @error('month') is-invalid @enderror" name="month">
                                <option>Select Month</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            @error('month')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row"></div>
                    <br>
                    <div class="row">
                        <div class="col-md-5">
                            <button><a href="{{ URL::to('generate-pdf') }}">Export PDF</a></button>
                            <button type="submit" class="btn btn-secondary">Print Report</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

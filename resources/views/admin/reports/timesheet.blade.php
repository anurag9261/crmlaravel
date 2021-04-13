@extends('admin.master')
@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Timesheet Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Timesheet Report</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        {{--  <button class="btn btn-secondary" style="float:right"><a href="{{route('admin.roles')}}"
                                style="color:white"><i class="fas fa-arrow-left"></i> Back</a></button>  --}}
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <section class="col-lg-9 connectedSortable">
            @if (session('error'))
            <div class="alert alert-warning">{{ session('error') }}</div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('report.timesheet') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <label for="employee">Select Employee</label>
                            <select class="form-control @error('emp') is-invalid @enderror" name="emp">
                                <option value="">Select Employee</option>
                                @foreach($employee as $profile)
                                    <option>{{ $profile->fname }}</option>
                                @endforeach
                            </select>
                            @error('emp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-5">
                            <label for="month">Select Month</label>
                            <input type="text" class="form-control @error('month') is-invalid @enderror" name="month" id="datepicker" placeholder="Select Month" />
                            @error('month')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5">
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




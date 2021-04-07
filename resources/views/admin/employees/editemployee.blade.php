@extends('admin.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Attandance</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Timesheet Management</li>
                        <li class="breadcrumb-item active">Edit Attandance</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-secondary" style="float:right"><a href="{{route('admin.employee')}}"
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
                    <form action="{{route('admin.updateemployee',[$admin->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <label for="employee">Employee Name</label>
                                <input type="text" class="form-control"
                                    name="employee" value="{{$admin->employee}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <label for="attandance">Attandance:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="attandance"
                                        id="present" onclick="show()" value="present" @if(@$admin->attandance == "present") checked @endif>
                                    <label class="form-check-label" for="present">
                                        Present
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="attandance"
                                        id="absent" onclick="hide()" value="absent"@if(@$admin->attandance == "absent") checked @endif>
                                    <label class="form-check-label" for="absent">
                                        Absent
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display: none;" id="toggle">
                            <div class="col-md-5">
                                <label for="intime">In Time</label>
                                <input type="time" class="form-control @error('intime') is-invalid @enderror" name="intime" value="{{$admin->intime}}">
                                @error('intime')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="outtime">Out Time</label>
                                <input type="time" class="form-control @error('outtime') is-invalid @enderror" name="outtime" value="{{$admin->outtime}}">
                                @error('outtime')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <label for="date">Current Date</label>
                                <input type="date" class="form-control @error('currentdate') is-invalid @enderror"
                                    name="currentdate" value="{{$admin->currentdate}}">
                                @error('currentdate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
<script type="text/javascript">
function hide(){
  document.getElementById('toggle').style.display ='none';
}
function show(){
  document.getElementById('toggle').style.display = 'block';
}
</script>
<script type="text/javascript">
   
    $(".attandance").change(function(){
        var selValue = $("input[type='radio']:checked").val();
        console.log(selValue);
    });
   
</script>

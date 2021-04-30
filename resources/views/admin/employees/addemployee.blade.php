@extends('admin.master')
@push('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .span {
        width: 100%;
        margin-top: .25rem;
        font-size: 80%;
        color: #dc3545;
        }
        .a{
            margin-left: 45px;
        }
        .b{
            margin-left:150px
        }
    </style>
@endpush
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add Attandance</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Timesheet Management</li>
                        <li class="breadcrumb-item active">Add Attandance</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-secondary" style="float:right"><a href="{{route('admin.employee')}}"
                                style="color:white"><i class="fas fa-arrow-left"></i> Back</a></button>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <section class="col-lg-9 connectedSortable">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.employeesubmit')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <label for="role">Employee Name</label>
                                @if(Auth::user()->role == 'Admin')
                                <select class="form-control  @error('employee') is-invalid @enderror" name="employee"
                                    placeholder="Select Employee">
                                    <option value="">Select Employee</option>
                                    @foreach($employee as $profile)
                                    <option value="{{ $profile->id  }}">{{$profile->fname}} {{ $profile->lname }}</option>
                                    @endforeach
                                </select>
                                @else
                                <input type="text" value="{{ Auth::user()->id }}" class="form-control" name="employee" hidden>
                                <input type="text" value="{{ Auth::user()->fname }} {{ Auth::user()->lname }}" class="form-control" readonly>
                                @endif
                                @error('employee')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="currentdate">Current Date</label>
                                <input type="text" id="datepicker2" class="form-control @error('currentdate') is-invalid @enderror"
                                    name="currentdate" placeholder="yyyy-mm-dd">
                                @error('currentdate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-10">
                                <label for="attendance">Attendance</label><br>
                                <input class="a @error('attandance') is-invalid
                                     @enderror" type="radio" name="attandance" id="present" onclick="show()"
                                    value="present"> <label>Present</label>
                                <input class="b @error('attandance') is-invalid
                                     @enderror" type="radio" name="attandance" id="absent" onclick="hide()"
                                    value="absent"> <label>Absent</label>
                                <br>
                                @error('attandance')
                                <span class="span" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3" style="display: none;" id="toggle">
                            <div class="col-md-5">
                                <label for="intime">In Time</label>
                                <input type="time" class="form-control @error('intime') is-invalid @enderror" name="intime">
                                @error('intime')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-5 mt-3">
                                <label for="lname">Out Time</label>
                                <input type="time" class="form-control @error('outtime') is-invalid @enderror" name="outtime">
                                @error('outtime')
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
@push('scripts')
<script type="text/javascript">
    function hide(){
  document.getElementById('toggle').style.display ='none';
}
function show(){
  document.getElementById('toggle').style.display = 'block';
}
</script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
    $("#datepicker2").datepicker({
        dateFormat: "yy-mm-dd"
    });
});
</script>
@endpush

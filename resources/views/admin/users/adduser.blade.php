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
    </style>
@endpush
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Admin</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.users') }}">User Management</a></li>
                        <li class="breadcrumb-item active">Add User</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-secondary" style="float:right"><a href="{{route('admin.users')}}"
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
                    <form action="{{ route('admin.usersubmit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <label for="fname">First Name</label><span style="color:rgb(245, 24, 24)">*</span>
                                <input type="text" class="form-control @error('fname') is-invalid @enderror"
                                    name="fname" placeholder="Enter First Name">
                                @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="lname">Last Name</label><span style="color:rgb(245, 24, 24)">*</span>
                                <input type="text" class="form-control @error('lname') is-invalid @enderror"
                                    name="lname" placeholder="Enter Last Name">
                                @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="mobno">Mobile Number</label><span style="color:rgb(245, 24, 24)">*</span>
                                <input type="number" class="form-control @error('mobno') is-invalid @enderror" name="mobno"
                                    placeholder="Enter Phone number">
                                @error('mobno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="email">Email</label><span style="color:rgb(245, 24, 24)">*</span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    placeholder="Enter Email Here">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="birth_date">Birth Date</label><span style="color:rgb(245, 24, 24)">*</span>
                                <input type="text" id="birthdate" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate"
                                    placeholder="yyyy-mm-dd" autocomplete="off">
                                @error('birthdate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="birth_date">Joining Date</label><span style="color:rgb(245, 24, 24)">*</span>
                                <input type="text" id="joiningdate" class="form-control @error('joining_date') is-invalid @enderror" name="joining_date"
                                    placeholder="yyyy-mm-dd" autocomplete="off">
                                @error('joining_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="gender">Gender</label><span style="color:rgb(245, 24, 24)">*</span>
                                <br>
                                <input type="radio" class="@error('gender') is-invalid @enderror" name="gender" value="1">
                                <label>Male</label>
                                <input type="radio" class="@error('gender') is-invalid @enderror" name="gender" value="2">
                                <label>Female</label>
                                <input type="radio" class="@error('gender') is-invalid @enderror" name="gender" value="3">
                                <label>Other</label>
                                <br>
                                @error('gender')
                                <span class="span" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="salarytype">Salary Type</label><span style="color:rgb(245, 24, 24)">*</span>
                                <br>
                                <input type="radio" name="salary_type" class="@error('salary_type') is-invalid @enderror" value="1">
                                <label>Hourly</label>
                                <input type="radio" name="salary_type" class="@error('salary_type') is-invalid @enderror" value="2">
                                <label>Monthly</label>
                                <br>
                                @error('salary_type')
                                <span class="span" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="role">Role</label><span style="color:rgb(245, 24, 24)">*</span>
                                <select class="form-control  @error('role') is-invalid @enderror" name="role">
                                    <option value="">Select Role</option>
                                    @foreach($roles as $profile)
                                    <option>{{$profile->title}}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="amount">Salary Amount(CAD)</label><span style="color:rgb(245, 24, 24)">*</span>
                                <input type="number" class="form-control @error('salary_amount') is-invalid @enderror" name="salary_amount"
                                    placeholder="Enter First Name" step="any">
                                @error('salary_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="image">Image</label><span style="color:rgb(245, 24, 24)">*</span>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                <p style="color:red;font-size:12px">*Image format must be jpeg,png,jpg</p>
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="status">Status</label><span style="color:rgb(245, 24, 24)">*</span>
                                <select class="form-control @error('status') is-invalid @enderror" name="status">
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">In Active</option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="address">Address</label><span style="color:rgb(245, 24, 24)">*</span>
                                <textarea class="form-control @error('address') is-invalid @enderror" name="address"
                                    placeholder="Enter Address Here"></textarea>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="city">City</label><span style="color:rgb(245, 24, 24)">*</span>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" placeholder="Enter City">
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="zipcode">Zip Code</label><span style="color:rgb(245, 24, 24)">*</span>
                                <input type="text" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode"
                                    placeholder="Enter Zip">
                                @error('zipcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="state">State</label><span style="color:rgb(245, 24, 24)">*</span>
                                <select name="state" class="form-control @error('state') is-invalid @enderror">
                                    <option value="">Select State</option>
                                    <option value="Alberta">Alberta</option>
                                    <option value="British Columbia">British Columbia</option>
                                    <option value="Manitoba">Manitoba</option>
                                    <option value="New Brunswick">New Brunswick</option>
                                    <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
                                    <option value="Nova Scotia">Nova Scotia</option>
                                    <option value="Ontario">Ontario</option>
                                    <option value="Prince Edward Island">Prince Edward Island</option>
                                    <option value="Quebec">Quebec</option>
                                    <option value="Saskatchewan">Saskatchewan</option>
                                    <option value="Yukon">Yukon</option>
                                    <option value="Nunavaut">Nunavaut</option>
                                    <option value="Northewst Territories">Northewst Territories</option>
                                </select>
                                @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="country">Country</label><span style="color:rgb(245, 24, 24)">*</span>
                                <input type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="Canada"
                                    readonly>
                                @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="password">password</label><span style="color:rgb(245, 24, 24)">*</span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                    placeholder="Enter Password Here">
                                @error('password')
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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
    $("#birthdate").datepicker({
        dateFormat: "yy-mm-dd"
    });
});
</script>
<script>
    $(function() {
    $("#joiningdate").datepicker({
        dateFormat: "yy-mm-dd"
    });
});
</script>
@endpush

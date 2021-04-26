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
                    <h1 class="m-0 text-dark">Edit User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">User Management</li>
                        <li class="breadcrumb-item active">Edit User</li>
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
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.update',[$profile->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if(Auth::user()->role == 'Admin')
                        <div class="row">
                            <div class="col-md-5">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control @error('fname') is-invalid @enderror"
                                    name="fname" value="{{$profile->fname}}">
                                @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control @error('lname') is-invalid @enderror"
                                    name="lname" value="{{$profile->lname}}">
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
                                <label for="mobno">Phone Number</label>
                                <input type="number" class="form-control @error('mobno') is-invalid @enderror"
                                    name="mobno" value="{{$profile->mobno}}">
                                @error('mobno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{$profile->email}}">
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
                                <label for="birth_date">Birth Date</label>
                                <input type="text" id="birthdate" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate"
                                    value="{{$profile->birthdate}}">
                                @error('birthdate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="birth_date">Joining Date</label>
                                <input type="text" id="joiningdate" class="form-control @error('joining_date') is-invalid @enderror"
                                    name="joining_date" value="{{$profile->joining_date}}">
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
                                <label for="gender">Gender</label>
                                <br>
                                <input type="radio" class="@error('gender') is-invalid @enderror" name="gender" value="1" {{ ($profile->gender) == '1' ? 'checked' : '' }}>
                                <label>Male</label>
                                <input type="radio" class="@error('gender') is-invalid @enderror" name="gender" value="2" {{ ($profile->gender) == '2' ? 'checked' : '' }}>
                                <label>Female</label>
                                <input type="radio" class="@error('gender') is-invalid @enderror" name="gender" value="0" {{ ($profile->gender) == '0' ? 'checked' : '' }}>
                                <label>Other</lable>
                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="salarytype">Salary Type</label>
                                <br>
                                <input type="radio" name="salary_type" value="1" {{ ($profile->salary_type) == '1' ? 'checked' : ''}}>
                                <label>Hourly</label>
                                <input type="radio" name="salary_type" value="2" {{ ($profile->salary_type) == '2' ? 'checked' : ''}}>
                                <label>Monthly</label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="role">Role</label>
                                <select class="form-control  @error('role') is-invalid @enderror" name="role">
                                    @foreach($roles as $roleSingle)
                                    <option>{{$roleSingle->title}}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="amount">Salary Amount</label>
                                <input type="number" class="form-control @error('salary_amount') is-invalid @enderror" name="salary_amount" value="{{ $profile->salary_amount }}"
                                    step="any">
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
                                <label for="image">Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                                    accept="image/x-png,image/gif,image/jpeg">
                                <p style="color:red;font-size:12px">*Image format must be jpeg,png,jpg with max-width:350px.</p>
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="status">Staus</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="1" {{ ($profile->status) == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ ($profile->status) == '0' ? 'selected' : '' }}>In Active</option>
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
                                <label for="address">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" name="address">{{$profile->address}}</textarea>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="city">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                                    value="{{ $profile->city }}">
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
                                <label for="state">State</label>
                                <select name="state" class="form-control">
                                    <option value="">Select State</option>
                                    <option value="Alberta" {{ ($profile->state) == 'Alberta' ? 'selected' : '' }}>Alberta
                                    </option>
                                    <option value="British_Columbia" {{ ($profile->state) == 'British_Columbia' ? 'selected' : '' }}>
                                        British Columbia</option>
                                    <option value="Manitoba" {{ ($profile->state) == 'Manitoba' ? 'selected' : '' }}>
                                        Manitoba</option>
                                    <option value="New_Brunswick" {{ ($profile->state) == 'New_Brunswick' ? 'selected' : '' }}>
                                        New Brunswick</option>
                                    <option value="Newfoundland_and_Labrador"
                                        {{ ($profile->state) == 'Newfoundland_and_Labrador' ? 'selected' : '' }}>
                                        Newfoundland and Labrador</option>
                                    <option value="Nova_Scotia" {{ ($profile->state) == 'Nova_Scotia' ? 'selected' : '' }}>
                                        Nova Scotia</option>
                                    <option value="Ontario" {{ ($profile->state) == 'Ontario' ? 'selected' : '' }}>
                                        Ontario</option>
                                    <option value="Prince_Edward_Island" {{ ($profile->state) == 'Prince_Edward_Island' ? 'selected' : '' }}>
                                        Prince Edward Island</option>
                                    <option value="Quebec" {{ ($profile->state) == 'Quebec' ? 'selected' : '' }}>
                                        Quebec</option>
                                    <option value="Saskatchewan" {{ ($profile->state) == 'Saskatchewan' ? 'selected' : '' }}>
                                        Saskatchewan</option>
                                    <option value="Yukon" {{ ($profile->state) == 'Yukon' ? 'selected' : '' }}>
                                        Yukon</option>
                                    <option value="Nunavaut" {{ ($profile->state) == 'Nunavaut' ? 'selected' : '' }}>
                                        Nunavaut</option>
                                    <option value="Northewst_Territories" {{ ($profile->state) == 'Northewst_Territories' ? 'selected' : '' }}>
                                        Northewst Territories</option>
                                </select>
                                @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="country">Country</label>
                                <input type="text" class="form-control @error('country') is-invalid @enderror" name="country"
                                    value="{{ $profile->country }}" readonly>
                                @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <img src="{{asset('images/'. $profile->image )}}" width="150px" , height="auto"></td>
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-md-5">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control @error('fname') is-invalid @enderror" name="fname"
                                    value="{{$profile->fname}}">
                                @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control @error('lname') is-invalid @enderror" name="lname"
                                    value="{{$profile->lname}}">
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
                                <label for="mobno">Phone Number</label>
                                <input type="number" class="form-control @error('mobno') is-invalid @enderror" name="mobno"
                                    value="{{$profile->mobno}}" readonly>
                                @error('mobno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{$profile->email}}" readonly>
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
                                <label for="birth_date">Birth Date</label>
                                <input type="text" id="birthdate" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate"
                                    value="{{$profile->birthdate}}">
                                @error('birthdate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="birth_date">Joining Date</label>
                                <input type="text" id="joiningdate" class="form-control @error('joining_date') is-invalid @enderror"
                                    name="joining_date" value="{{$profile->joining_date}}" readonly>
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
                                <label for="gender">Gender</label>
                                <br>
                                <input type="radio" class="@error('gender') is-invalid @enderror" name="gender" value="1"
                                    {{ ($profile->gender) == '1' ? 'checked' : '' }} disabled>
                                <label>Male</label>
                                <input type="radio" class="@error('gender') is-invalid @enderror" name="gender" value="2"
                                    {{ ($profile->gender) == '2' ? 'checked' : '' }} disabled>
                                <label>Female</label>
                                <input type="radio" class="@error('gender') is-invalid @enderror" name="gender" value="0"
                                    {{ ($profile->gender) == '0' ? 'checked' : '' }} disabled>
                                <label>Other</lable>
                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="salarytype">Salary Type</label>
                                <br>
                                <input type="radio" name="salary_type" value="1" {{ ($profile->salary_type) == '1' ? 'checked' : ''}} disabled>
                                <label>Hourly</label>
                                <input type="radio" name="salary_type" value="2" {{ ($profile->salary_type) == '2' ? 'checked' : ''}} disabled>
                                <label>Monthly</label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="role">Role</label>
                                <select class="form-control  @error('role') is-invalid @enderror" name="role">
                                    @foreach($roles as $roleSingle)
                                    <option value="{{ $roleSingle->title }}" {{ ($roleSingle->title) == $roleSingle->title ? 'selected' : '' }} disabled>{{ $roleSingle->title }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="amount">Salary Amount</label>
                                <input type="number" class="form-control @error('salary_amount') is-invalid @enderror" name="salary_amount"
                                    value="{{ $profile->salary_amount }}" step="any" readonly>
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
                                <label for="image">Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                                    accept="image/x-png,image/gif,image/jpeg">
                                <p style="color:red;font-size:12px">*Image format must be jpeg,png,jpg with max-width:350px.</p>
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="status">Staus</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="1" {{ ($profile->status) == '1' ? 'selected' : '' }} disabled>Active</option>
                                    <option value="0" {{ ($profile->status) == '0' ? 'selected' : '' }} disabled>In Active</option>
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
                                <label for="address">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror"
                                    name="address">{{$profile->address}}</textarea>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="city">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                                    value="{{ $profile->city }}">
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
                                <label for="state">State</label>
                                <select name="state" class="form-control">
                                    <option value="">Select State</option>
                                    <option value="Alberta" {{ ($profile->state) == 'Alberta' ? 'selected' : '' }}>Alberta
                                    </option>
                                    <option value="British_Columbia" {{ ($profile->state) == 'British_Columbia' ? 'selected' : '' }}>
                                        British Columbia</option>
                                    <option value="Manitoba" {{ ($profile->state) == 'Manitoba' ? 'selected' : '' }}>
                                        Manitoba</option>
                                    <option value="New_Brunswick" {{ ($profile->state) == 'New_Brunswick' ? 'selected' : '' }}>
                                        New Brunswick</option>
                                    <option value="Newfoundland_and_Labrador"
                                        {{ ($profile->state) == 'Newfoundland_and_Labrador' ? 'selected' : '' }}>
                                        Newfoundland and Labrador</option>
                                    <option value="Nova_Scotia" {{ ($profile->state) == 'Nova_Scotia' ? 'selected' : '' }}>
                                        Nova Scotia</option>
                                    <option value="Ontario" {{ ($profile->state) == 'Ontario' ? 'selected' : '' }}>
                                        Ontario</option>
                                    <option value="Prince_Edward_Island" {{ ($profile->state) == 'Prince_Edward_Island' ? 'selected' : '' }}>
                                        Prince Edward Island</option>
                                    <option value="Quebec" {{ ($profile->state) == 'Quebec' ? 'selected' : '' }}>
                                        Quebec</option>
                                    <option value="Saskatchewan" {{ ($profile->state) == 'Saskatchewan' ? 'selected' : '' }}>
                                        Saskatchewan</option>
                                    <option value="Yukon" {{ ($profile->state) == 'Yukon' ? 'selected' : '' }}>
                                        Yukon</option>
                                    <option value="Nunavaut" {{ ($profile->state) == 'Nunavaut' ? 'selected' : '' }}>
                                        Nunavaut</option>
                                    <option value="Northewst_Territories" {{ ($profile->state) == 'Northewst_Territories' ? 'selected' : '' }}>
                                        Northewst Territories</option>
                                </select>
                                @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="country">Country</label>
                                <input type="text" class="form-control @error('country') is-invalid @enderror" name="country"
                                    value="{{ $profile->country }}" readonly>
                                @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <img src="{{asset('images/'. $profile->image )}}" width="150px" , height="auto"></td>
                            </div>
                        </div>
                        @endif
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

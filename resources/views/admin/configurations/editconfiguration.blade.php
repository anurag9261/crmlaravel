@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Site Configuration</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                        <li class="breadcrumb-item active">Edit Configuration</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <section class="col-lg-9 connectedSortable">
            <div class="card">
                <div class="card-body">
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    <form action="{{route('admin.updateconfiguration',[$profile->id])}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <label for="company_name">Company Name</label><span style="color:rgb(245, 24, 24)">*</span>
                                <input type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name"
                                    value="{{ $profile->company_name }}" placeholder="Enter Company Name">
                                @error('company_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="title">Vat Number</label><span style="color:rgb(245, 24, 24)">*</span>
                                <input type="number" class="form-control @error('vat_number') is-invalid @enderror" name="vat_number"
                                    value="{{ $profile->vat_number }}" placeholder="Enter Weight Number">
                                @error('vat_number')
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
                                <input type="text" class="form-control @error('mobno') is-invalid @enderror" name="mobno"
                                    value="{{$profile->mobno}}" placeholder="Enter Site Name">
                                @error('mobno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="site_name">Site Name</label><span style="color:rgb(245, 24, 24)">*</span>
                                <input type="text" class="form-control @error('site_name') is-invalid @enderror" name="site_name"
                                    value="{{$profile->site_name}}" placeholder="Enter Site Name">
                                @error('site_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="title">Site Title</label><span style="color:rgb(245, 24, 24)">*</span>
                                <input type="text" class="form-control @error('site_title') is-invalid @enderror"
                                    name="site_title" value="{{$profile->site_title}}" placeholder="Enter Site Title">
                                @error('site_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="site_logo">Site Logo</label>
                                <input type="file" class="form-control @error('site_logo') is-invalid @enderror" name="site_logo">
                                <p style="color:red;font-size:12px">*Image format must be jpeg,png,jpg.</p>
                                @error('site_logo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="favicon_icon">Favicon Icon</label>
                                <input type="file" class="form-control @error('favicon_icon') is-invalid @enderror" name="favicon_icon">
                                <p style="color:red;font-size:12px">*Image format must be jpeg,png,jpg.</p>
                                @error('favicon_icon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <img src="{{asset('images/profile/'. $profile->site_logo)}}" width="80px" , height="auto" ,>
                            </div>
                            <div class="col-md-5">
                                <img src="{{asset('images/profile/'. $profile->favicon_icon)}}" width="80px" , height="auto" ,>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="address">Address</label><span style="color:rgb(245, 24, 24)">*</span>
                                <textarea class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Enter Address">{{ $profile->address }}</textarea>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="city">City</label><span style="color:rgb(245, 24, 24)">*</span>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $profile->city }}">
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
                                <input type="number" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" value="{{ $profile->zipcode }}">
                                @error('zipcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="state">State</label><span style="color:rgb(245, 24, 24)">*</span>
                                <select name="state" class="form-control">
                                    <option value="">Select States</option>
                                    <option value="Alberta" {{ ($profile->state) == 'Alberta' ? 'selected' : '' }}>Alberta
                                    </option>
                                    <option value="British Columbia" {{ ($profile->state) == 'British Columbia' ? 'selected' : '' }}>
                                        British Columbia</option>
                                    <option value="Manitoba" {{ ($profile->state) == 'Manitoba' ? 'selected' : '' }}>
                                        Manitoba</option>
                                    <option value="New Brunswick" {{ ($profile->state) == 'New Brunswick' ? 'selected' : '' }}>
                                        New Brunswick</option>
                                    <option value="Newfoundland and Labrador"
                                        {{ ($profile->state) == 'Newfoundland and Labrador' ? 'selected' : '' }}>
                                        Newfoundland and Labrador</option>
                                    <option value="Nova Scotia" {{ ($profile->state) == 'Nova Scotia' ? 'selected' : '' }}>
                                        Nova Scotia</option>
                                    <option value="Ontario" {{ ($profile->state) == 'Ontario' ? 'selected' : '' }}>
                                        Ontario</option>
                                    <option value="Prince Edward Island"
                                        {{ ($profile->state) == 'Prince Edward Island' ? 'selected' : '' }}>
                                        Prince Edward Island</option>
                                    <option value="Quebec" {{ ($profile->state) == 'Quebec' ? 'selected' : '' }}>
                                        Quebec</option>
                                    <option value="Saskatchewan" {{ ($profile->state) == 'Saskatchewan' ? 'selected' : '' }}>
                                        Saskatchewan</option>
                                    <option value="Yukon" {{ ($profile->state) == 'Yukon' ? 'selected' : '' }}>
                                        Yukon</option>
                                    <option value="Nunavaut" {{ ($profile->state) == 'Nunavaut' ? 'selected' : '' }}>
                                        Nunavaut</option>
                                    <option value="Northewst Territories"
                                        {{ ($profile->state) == 'Northewst Territories' ? 'selected' : '' }}>
                                        Northewst Territories</option>
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
                        <button type="submit" class="btn btn-secondary">Update</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

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
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
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
                                <label for="site_name">Site Name</label>
                                <input type="text" class="form-control @error('site_name') is-invalid @enderror"
                                    name="site_name" value="{{$profile->site_name}}" placeholder="Enter Site Name">
                                @error('site_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="title">Site Title</label>
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
                        <div class="row">
                            <div class="col-md-5">
                                <img src="{{asset('images/profile/'. $profile->site_logo)}}" width="80px", height="auto",>
                            </div>
                            <div class="col-md-5">
                                <img src="{{asset('images/profile/'. $profile->favicon_icon)}}" width="80px" , height="auto" ,>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-10">
                                <label for="address">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Enter Address">{{ $profile->address }}</textarea>
                                @error('address')
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

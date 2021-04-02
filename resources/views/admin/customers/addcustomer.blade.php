@extends('admin.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add Customer</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Add Customer</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-secondary" style="float:right"><a href="{{route('admin.customers')}}"
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
                    <form action="{{route('admin.customersubmit')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control @error('fname') is-invalid @enderror"
                                    name="fname" placeholder="Enter First Name">
                                @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="lname">Last Name</label>
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
                                <label for="mobno">Phone Number</label>
                                <input type="number" class="form-control @error('mobno') is-invalid @enderror"
                                    name="mobno" placeholder="Enter Phone number">
                                @error('mobno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" placeholder="Enter Email Here">
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
                                <label for="address">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    name="address" placeholder="Enter Address Here">
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                            <label for="image">Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="status">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status">
                                    <option>Active</option>
                                    <option>InActive</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="password">password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" placeholder="Enter Password Here">
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
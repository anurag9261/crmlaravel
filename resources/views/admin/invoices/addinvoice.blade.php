@extends('admin.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add Invoice</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Add Invoice</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <button class="btn btn-outline-info" style="float:right"><a href="{{route('admin.invoices')}}" style="color:black"><i class="fas fa-arrow-left">Back</i></a></button>
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
                                <label for="role">Select Role</label>
                                <select class="form-control">
                                    <option>Admin</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="role">  Employee Name</label>
                                <select class="form-control">
                                    <option>Admin</option>
                                    <option>Admin</option>
                                </select>
                            </div>
                        </div>
                        <br>
                       <div class="row">
                            <div class="col-md-5">
                                <label for="role">Customer Name</label>
                                <select class="form-control">
                                    <option>Admin</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="role">Title</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="title" placeholder="Enter Title Here">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="role">Tasks</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="title" placeholder="Enter Title Here">
                            </div>
                            <div class="col-md-4">
                                <label for="role">Hour</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="title" placeholder="Enter Title Here">
                            </div>
                            <div class="col-md-4">
                                <label for="role">Price</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="title" placeholder="Enter Title Here">
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
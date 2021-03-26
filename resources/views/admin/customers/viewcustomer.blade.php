@extends('admin.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View Customer</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">View Customer</li>
                    </ol>
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
                <table class="table table-bordered table-striped">
                        <tr>
                            <th>Id</th>
                            <td>{{$profile->id}}</td>
                        </tr>
                        <tr>
                            <th>First Name</th>
                            <td>{{$profile->fname}}</td>
                            
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td>{{$profile->lname}}</td>
                            
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$profile->email}}</td>
                            
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td><img src="{{asset('images/'. $profile->image)}}" width="60px", height="60px",></td>
                            
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{$profile->status}}</td>
                        </tr>                        
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
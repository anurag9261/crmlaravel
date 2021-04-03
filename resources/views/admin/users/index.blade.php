@extends('admin.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Users Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-secondary" style="float:right"><a
                                href="{{route('admin.adduser')}}" style="color:white"><i class="fas fa-plus"></i> Add
                                    User</a></button>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
                <div class="card-body">
                    @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                    @endif
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    {{-- <form action="{{ route('admin.search') }}" method="GET">
                        <button type="submit" class="btn btn-success" style="float:right;height:30px">Search</button>
                        <input type="text" name="search" style="float: right;" required />

                    </form> --}}
                    <table id="data" class="table table-bordered table-striped">
                        <tr class="">
                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Mobile No</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        
                        @foreach($profile as $data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->fname}}</td>
                            <td>{{$data->lname}}</td>
                            <td>{{$data->mobno}}</td>
                            <td>{{$data->email}}</td>
                            <td><img src="{{asset('images/'. $data->image)}}" width="50px" , height="auto"></td>
                            <td>{{$data->role}}</td>
                            <td>
                                <button type="button" class="btn btn-secondary"><a href="viewuser{{$data->id}}"
                                        style="color:white"><i class="far fa-eye"></i></a></button>
                                <button type="button" class="btn btn-secondary"><a href="edituser{{$data->id}}"
                                        style="color:white"><i class="far fa-edit"></i></a></button>
                                <button type="button" class="btn btn-secondary"><a href="deleteuser{{$data->id}}"
                                        style="color:white"><i class="far fa-trash-alt"></i></a></button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <br>    
                    <span style="float:right">
                        {{$profile->links()}}
                    </span>
                    <br>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
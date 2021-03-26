@extends('admin.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Roles Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Roles</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-secondary" style="float:right"><a href="{{route('admin.addrole')}}"
                                style="color:white"><i class="fas fa-plus">Add
                                    Role</i></a></button>
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
                    <table class="table table-bordered table-striped">
                        <tr class="">
                            <th>Id</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>CreatedAt</th>
                            <th>UpdatedAt</th>
                            <th>Action</th>
                        </tr>
                        @foreach($profile as $data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->title}}</td>
                            <td>@if($data->status == 'Active')
                                <span class="badge badge-success">Active</span>
                                @elseif($data->status == 'InActive')
                                <span class="badge badge-danger">InActive</span>
                                @endif
                            </td>
                            <td>{{$data->created_at}}</td>
                            <td>{{$data->updated_at}}</td>
                            <td>
                                <button type="button" class="btn btn-outline-info"><a href="viewrole{{$data->id}}"
                                        style="color:black"><i class="fas fa-eye"></i></a></button>
                                <button type="button" class="btn btn-outline-warning"><a href="editrole{{$data->id}}"
                                        style="color:black"><i class="fas fa-edit"></i></a></button>
                                <button type="button" class="btn btn-outline-danger"><a href="delete{{$data->id}}"
                                        style="color:black"><i class="fas fa-trash-alt"></i></a></button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <br>
                    <span style="float:right">
                        {{$profile->links()}}
                    </span>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
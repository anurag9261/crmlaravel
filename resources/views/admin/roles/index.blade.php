@extends('admin.master')
@push('styles')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Role Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Admin</a></li>
                        <li class="breadcrumb-item active">Role Management</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-secondary" style="float:right"><a href="{{route('admin.addrole')}}"
                                style="color:white"><i class="fas fa-plus"></i>
                                    </i> Add Role</a></button>
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
                            <th>No</th>
                            <th>Title</th>
                            <th>Status</th>
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
                            <td>

                                <button type="button" class="btn btn-secondary"><a href="viewrole{{$data->id}}"
                                        style="color:white"><i class="far fa-eye"></i></a></button>
                                <button type="button" class="btn btn-secondary"><a href="editrole{{$data->id}}"
                                        style="color:white"><i class="far fa-edit"></i></a></button>
                                <button type="button" class="btn btn-secondary" onclick="alert('Are you sure!')"><a href="deleterole{{$data->id}}"
                                        style="color:white"><i class="far fa-trash-alt"></i></a></button>

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
@push('scripts')
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready( function () {
    $('#myTable12').DataTable();
} );
</script>
@endpush

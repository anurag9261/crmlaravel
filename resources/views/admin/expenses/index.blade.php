@extends('admin.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Expense Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Expense Records</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                    <button class="btn btn-secondary" style="float:right"><a href="{{route('admin.addexpense')}}" style="color:white"><i class="fas fa-plus"></i> Add Expense</a></button>
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
                    <table id="data" class="table table-bordered table-striped">
                        <tr class="">
                            <th>No</th>
                            <th>Category Name</th>
                            <th>Entry Date</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                        @foreach($profile as $data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->category}}</td>
                            <td>{{$data->entry_date}}</td>
                            <td>{{$data->amount}}</td>
                            <td>
                                <button type="button" class="btn btn-secondary"><a href="viewexpense{{$data->id}}"
                                        style="color:white"><i class="far fa-eye"></i></a></button>
                                <button type="button" class="btn btn-secondary"><a
                                        href="editexpense{{$data->id}}" style="color:white"><i
                                            class="far fa-edit"></i></a></button>
                                <button type="button" class="btn btn-secondary" onclick="alert('Are you sure!')"><a
                                        href="deleteexpense{{$data->id}}" style="color:white"><i
                                            class="far fa-trash-alt"></i></a></button>
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
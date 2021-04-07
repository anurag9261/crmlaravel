@extends('admin.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View Expense</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Expense Management</li>
                        <li class="breadcrumb-item active">View Expense</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <button class="btn btn-secondary" style="float:right"><a href="{{route('admin.expenses')}}" style="color:white"><i class="fas fa-arrow-left"></i> Back</a></button>
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
                            <th>Category Name</th>
                            <td>{{$profile->category}}</td>
                            
                        </tr>
                        <tr>
                            <th>Entry Date</th>
                            <td>{{$profile->entry_date}}</td>
                            
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td>{{$profile->amount}}</td>
                            
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{$profile->description}}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{$profile->created_at}}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{$profile->updated_at}}</td>
                        </tr>                        
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
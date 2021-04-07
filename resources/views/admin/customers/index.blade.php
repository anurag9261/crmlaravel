@extends('admin.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Customer Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Customer Management</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                    <button class="btn btn-secondary" style="float:right"><a href="{{route('admin.addcustomer')}}" style="color:white"><i class="fas fa-plus"></i> Add Customer</a></button>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
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
                    <table id="empTable" class="table table-bordered table-striped">
                        <tr class="">
                            <th>No</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Stauts</th>
                            <th>Action</th>
                        </tr>
                        @foreach($profile as $data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->fname}}</td>
                            <td>{{$data->lname}}</td>
                            <td>{{$data->email}}</td>
                            <td><img src="{{asset('images/'. $data->image)}}" width="50px", height="auto",></td>
                            <td>
                            @if($data->status == 'Active')
                            <span class="badge badge-success">Active</span>
                            @elseif($data->status == 'InActive')
                            <span class="badge badge-danger">InActive</span>
                            @endif
                            </td>
                            <td>
                            <button type="button" class="btn btn-secondary"><a href="viewcustomer{{$data->id}}" style="color:white"><i class="far fa-eye"></i></a></button>
                            <button type="button" class="btn btn-secondary"><a href="editcustomer{{$data->id}}" style="color:white"><i class="far fa-edit"></i></a></button>
                            <button type="button" class="btn btn-secondary" onclick="alert('Are you sure!')"><a href="deletecustomer/{{$data->id}}" style="color:white"><i class="far fa-trash-alt"></i></a></button>
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
<!-- Script -->
<script type="text/javascript">
    $(document).ready(function(){

      // DataTable
      $('#empTable').DataTable({
         processing: true,
         serverSide: true,
         ajax: "{{route('admin.getCustomers')}}",
         columns: [
            { data: 'id' },
            { data: 'fname' },
            { data: 'lname' },
            { data: 'email' },
         ]
      });

    });
    </script>

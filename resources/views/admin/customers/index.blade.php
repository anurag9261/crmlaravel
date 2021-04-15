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
                <div class="container mt-3 mb-3">
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
                        <thead>
                        <tr class="" style="background: #6c757d; color: #fff; border-color: #6c757d;">
                            <th>No</td>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Mob No</th>
                            <th>Image</th>
                            <th>Stauts</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        $('#empTable').DataTable({
             processing:true,
             serverSide:true,
             ajax:"{{ route('admin.getcustomers') }}",
            columns:[
            {data: 'id', name: 'id'},
            {data: 'fname', name: 'fname'},
            {data: 'lname', name: 'lname'},
            {data: 'email', name: 'email'},
            {data: 'mobno', name: 'mobno'},
            {
                name: "image",
                data: "image",
                render: function (data, type, full, meta) {
                    return "<img src=\"/images/" + data + "\" width=\"50\" height=\"50\"/ >";
                },
                title: "Image",
                orderable: true,
                searchable: true
            },
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
            ],



        })
    });
</script>
@endpush



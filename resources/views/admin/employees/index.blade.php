@extends('admin.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Employee Records</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Employee Records</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <span data-href="/Employee" id="export" class="btn btn-success btn-sm" style="cursor:pointer"
                        onclick="exportTasks(event.target);">Export Excel</span>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-secondary" style="float:right"><a
                                href="{{route('admin.addemployee')}}" style="color:white"><i class="fas fa-plus">Add
                                    Employee Records</i></a></button>
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
                            <th>Employee</th>
                            <th>Attandance</th>
                            <th>CurrentDate</th>
                            <th>Total Time</th>
                            <th>Action</th>
                        </tr>
                        @foreach($employeData['emp'] as $data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->employee}}</td>
                            <td>{{$data->attandance}}</td>
                            <td>{{$data->currentdate}}</td>
                            <td>{{$data->time}}</td>
                            <td>
                                <button type="button" class="btn btn-outline-info"><a href="viewemployee{{$data->id}}"
                                        style="color:black"><i class="fas fa-eye"></i></a></button>
                                <button type="button" class="btn btn-outline-warning"><a
                                        href="editemployee{{$data->id}}" style="color:black"><i
                                            class="fas fa-edit"></i></a></button>
                                <button type="button" class="btn btn-outline-danger"><a
                                        href="deleteemployee{{$data->id}}" style="color:black"><i
                                            class="fas fa-trash-alt"></i></a></button>
                            </td>
                        </tr>
                        @endforeach
                        <?php ?>

                    </table>
                    <br>
                    <span style="float:right">
                        {{-- $employeData['emp']->links() --}}
                    </span>
                    <br>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
<script>
function exportTasks(_this) {
    let _url = $(_this).data('href');
    window.location.href = _url;
}
</script>
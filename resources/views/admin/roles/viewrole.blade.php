@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View Role</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Role Management</li>
                        <li class="breadcrumb-item active">View Role</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-secondary" style="float:right"><a href="{{route('admin.roles')}}"
                                style="color:white"><i class="fas fa-arrow-left"></i> Back</a></button>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <!-- Left col -->
        <section class="col-lg-9 connectedSortable">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Id</th>
                            <td>{{$profile->id}}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{$profile->title}}</td>

                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{$profile->status}}</td>

                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{$profile->created_at->format('Y-m-d')}}</td>

                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{$profile->updated_at->format('Y-m-d')}}</td>

                        </tr>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

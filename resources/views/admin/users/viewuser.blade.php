@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.users') }}">User Management</a></li>
                        <li class="breadcrumb-item active">View User</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-secondary" style="float:right"><a href="{{route('admin.users')}}"
                                style="color:white"><i class="fas fa-arrow-left"></i> Back</a></button>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <section class="col-lg-9 connectedSortable">
            <div class="card">
                <div class="card-body">
                <table class="table table-bordered table-striped">
                        <tr>
                            <th>Id</th>
                            <td>{{$profile->id}}</td>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td><img src="{{asset('images/'. $profile->image)}}" width="60px" , height="60px" ,></td>

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
                            <th>Mobile No</th>
                            <td>{{$profile->mobno}}</td>

                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$profile->email}}</td>

                        </tr>
                        <tr>
                            <th>Birth Date</th>
                            <td>{{$profile->birthdate}}</td>

                        </tr>
                        <tr>
                            <th>Joining Date</th>
                            <td>{{$profile->joining_date}}</td>

                        </tr>
                        <tr>
                            <th>Gender</th>
                            @if($profile->gender == 1)
                                <td>Male</td>
                            @elseif($profile->gender == 2)
                                <td>Female</td>
                            @else
                                <td>Other</td>
                            @endif
                        </tr>
                        <tr>
                            <th>Salary Type</th>
                            @if($profile->salary_type == 1)
                                <td>Hourly</td>
                            @else
                                <td>Monthly</td>
                            @endif
                        </tr>
                        <tr>
                            <th>Salary Amount</th>
                            <td>{{ $profile->salary_amount }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>{{$profile->role}}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            @if($profile->status == 1)
                            <td>Active</td>
                            @else
                            <td>In Active</td>
                            @endif
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{$profile->address}}, {{ $profile->city }}, {{ $profile->state }}, {{ $profile->country }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{$profile->created_at->format('Y-m-d')}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

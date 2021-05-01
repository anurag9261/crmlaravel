@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View Attandance</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="route('admin.dashboard')">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.employee') }}">Timesheet Management</a></li>
                        <li class="breadcrumb-item active">View Attandance</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <button class="btn btn-secondary" style="float:right"><a href="{{route('admin.employee')}}" style="color:white"><i class="fas fa-arrow-left"></i> Back</a></button>
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
                            <td>{{$profile[0]->id}}</td>
                        </tr>
                        <tr>
                            <th>Employee</th>
                            <td>{{ $profile[0]->fname }} {{ $profile[0]->lname }}</td>

                        </tr>
                        <tr>
                            <th>Attandance</th>
                            <td>{{$profile[0]->attandance}}</td>

                        </tr>
                        <tr>
                            <th>CurrentDate</th>
                            <td>{{$profile[0]->currentdate}}</td>

                        </tr>
                        <tr>
                        @if($profile[0]->intime == "")
                            <tr>
                                <th>InTime</th>
                                <td>NA</td>
                            </tr>
                        @else
                            <th>In Time</th>
                            <td>{{$profile[0]->intime}}</td>
                            @endif
                        </tr>
                        <tr>
                        @if($profile[0]->outtime == "")
                            <th>OutTime</th>
                            <td>NA</td>
                        @else
                            <th>Out Time</th>
                            <td>{{$profile[0]->outtime}}</td>
                        @endif
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{$profile[0]->created_at->format('Y-m-d')}}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{$profile[0]->updated_at->format('Y-m-d')}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

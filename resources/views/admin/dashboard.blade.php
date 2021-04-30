@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$admin}}</h3>

                            <p>Admins</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{route('admin.users')}}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{$employee}}</h3>

                            <p>Employees</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route('admin.users')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$customer}}</h3>

                            <p>Customers</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('admin.customers')}}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-6 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Invoice Report
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <div id="chart1" style="height: 300px; width: 100%;"></div>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- right col -->
                </section>
                <section class="col-lg-6 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-line mr-1"></i>
                                Employee Report
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <div id="chart2" style="height: 300px; width: 100%;"></div>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- right col -->
                </section>
            </div>
            <div class="card">
                <div class="card-body">
                <h3>Employee Records</h3>
                    <table id="data" class="table table-bordered table-striped">
                        <tr class="">
                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Mobile No</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Status</th>
                        </tr>
                      @foreach($profile as $data)
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->fname}}</td>
                            <td>{{$data->lname}}</td>
                            <td>{{$data->mobno}}</td>
                            <td>{{$data->email}}</td>
                            <td><img src="{{asset('images/'. $data->image)}}" width="60px" , height="60px" ,></td>
                            <td>@if($data->status == '1')
                            <span class="badge badge-success">Active</span>
                            @elseif($data->status == '0')
                            <span class="badge badge-danger">InActive</span>
                            @endif</td>
                        </tr>
                        @endforeach
                    </table>
                    <br>
                    <br>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                <h3>Customer Records</h3>
                    <table id="data" class="table table-bordered table-striped">
                        <tr class="">
                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Mobile No</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Status</th>
                        </tr>

                     @foreach($customers as $data)
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->fname}}</td>
                            <td>{{$data->lname}}</td>
                            <td>{{$data->mobno}}</td>
                            <td>{{$data->email}}</td>
                            <td><img src="{{asset('images/'. $data->image)}}" width="60px" , height="60px"></td>
                            <td>
                            @if($data->status == 'Active')
                            <span class="badge badge-success">Active</span>
                            @elseif($data->status == 'InActive')
                            <span class="badge badge-danger">InActive</span>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                    <br>
                    <br>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                <h3>Invoice Records</h3>
                    <table class="table table-bordered table-striped">
                        <tr class="">
                            <th>Invoice No</th>
                            <th>Title</th>
                            <th>Bill To</th>
                            <th>Due Date</th>
                            <th>Total</th>
                        </tr>
                        @foreach($invoice as $data)
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->title}}</td>
                            <td>{{$data->bill_to}}</td>
                            <td>{{$data->due_date}}</td>
                            <td>{{$data->total_amount}}</td>
                        </tr>
                        @endforeach
                    </table>
                    <br>
                </div>
            </div>
    </section>
</div>
</div>
</section>
</div>
@endsection
@push('scripts')
<script>
window.onload = function() {

    var chart1 = new CanvasJS.Chart("chart1", {
        animationEnabled: true,
        data: [{
            type: "pie",
            startAngle: 240,
            yValueFormatString: "##0.00\"%\"",
            indexLabel: "{label} {y}",
            dataPoints: [
                {y: {{ $paid_1 }}, label: "Paid Invoice"},
                {y: {{ $pending_1 }}, label: "Pending Invoice"},
            ]
        }]
    });
    var chart2 = new CanvasJS.Chart("chart2", {
        animationEnabled: true,
        theme: "light2", // "light2", "light2", "dark1", "dark2"
        axisY: {
            title: "Number of Employee"
        },
        data: [{
            type: "column",
            showInLegend: true,
            legendMarkerColor: "grey",
            legendText: "Salary per Hour",
            dataPoints: [
                { y: {{ $Hourly }}, label: "Hourly Salary" },
                { y: {{ $Monthly }}, label: "Monthly Salary" },
            ]
        }]
    });
chart1.render();
chart2.render();
}
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endpush

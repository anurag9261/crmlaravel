<!DOCTYPE html>
<html>
<head>
    <style>
    * {
        font-family: "Roboto", sans-serif;

    }

    .layout-fixed .main-sidebar {
    font-size: 15px;
    }
    </style>
    <style>
        .dropdown{
            margin-right: 50px;
        }

        .dropdown-menu.show {
        left: -28px;
        width: 190px;
        }
    </style>
    <link href="{{ asset('Datatables/datatables.min.css') }}" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CRM | Admin Panel</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">
    <link rel="icon" href="{{ URL::asset('/images/profile/'.$config[0]->favicon_icon) }}" type="image/x-icon" />
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{route('admin.dashboard')}}" class="nav-link">Home</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav dropdown ml-auto">
                <img src="{{ asset('/images/'.Auth::user()->image)}}" class="img-circle elevation-2" alt="User Image"
                    style="width:40px">
                <li class="nav-item nav-dropdown">
                    <a class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">{{ Auth::user()->fname }}</a>
                    <ul class="nav-item dropdown-menu">
                        <li>
                        <a href="{{URL::asset('edituser').Auth::user()->id}}" class="nav-link">
                            <i class="nav-icon fas fa-user-edit"></i> My Profile
                        </a>
                        </li>
                        <li>
                            <a href="editPassword{{Auth::user()->id }}" class="nav-link">
                                <i class="nav-icon fas fa-key"></i> Change Password
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/logout')}}" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{route('admin.dashboard')}}" class="brand-link">
                <img src="{{ asset('/images/profile/'. $config[0]->site_logo)}}" alt="" class="brand-image img-circle elevation-3"
                    style="opacity: .8;">
                <span class="brand-text font-weight-light">{{ $config[0]->site_title }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('/images/'.Auth::user()->image)}}" class="img-circle elevation-2"
                            alt="User Image" style="width:60px">
                    </div>
                </div> --}}
                <!-- Sidebar Menu -->
                <nav class="mt-3">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        {{--  <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    {{ Auth::user()->fname }}
                                </p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item has-treeview">
                                    <a href="{{URL::asset('edituser').Auth::user()->id}}" class="nav-link">
                                        <i class="nav-icon fas fa-user-edit"></i>
                                        <p style="font-size:14px;">Manage Profile</p>
                                    </a>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="editPassword{{Auth::user()->id }}" class="nav-link">
                                        <i class="nav-icon fas fa-key"></i>
                                        <p style="font-size:14px;">Change Password</p>
                                    </a>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="{{url('/logout')}}" class="nav-link">
                                        <i class="nav-icon fas fa-sign-out-alt"></i>
                                        <p style="font-size:14px;">Logout</p>
                                    </a>
                                </li>
                            </ul>
                        </li>  --}}
                        <li class="nav-item has-treeview">
                            <a href="{{url('/admin')}}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                       @if(auth()->user()->role == 'Admin')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    User Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.users')}}" class="nav-link">
                                        <i class="nav-icon fas fa-user"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.roles')}}" class="nav-link">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>Add Role</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.employee')}}" class="nav-link">
                                        <i class="nav-icon fas fa-calendar-alt"></i>
                                        <p>Timesheet Management</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{route('admin.employee')}}" class="nav-link">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>Timesheet Management</p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item has-treeview">
                            <a href="{{route('admin.customers')}}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Customer Management
                                </p>
                            </a>
                        </li>
                        @if(Auth::user()->role == 'Admin')
                        <li class="nav-item has-treeview">
                            <a href="{{route('admin.invoices')}}" class="nav-link">
                                <i class="nav-icon fas fa-receipt"></i>
                                <p>
                                    Invoice Management
                                </p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item has-treeview">
                            <a href="{{route('admin.expenses')}}" class="nav-link">
                                <i class="nav-icon fas fa-money-bill-alt"></i>
                                <p>
                                    Expense Management
                                </p>
                            </a>
                        </li>
                        @if(auth()->user()->role == 'Admin')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-poll"></i>
                                <p>
                                    Report Managment
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.timesheetreport')}}" class="nav-link">
                                        <i class="nav-icon fas fa-calendar-alt"></i>
                                        <p>Timesheet Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.employeereport')}}" class="nav-link">
                                    <i class="nav-icon fas fa-user-tie"></i>
                                        <p>Employee Report</p>
                                    </a>
                                </li>
                               <li class="nav-item">
                                    <a href="{{route('admin.invoicereport')}}" class="nav-link">
                                        <i class="nav-icon fas fa-receipt"></i>
                                        <p>Invoice Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.balancesheetreport')}}" class="nav-link">
                                        <i class="nav-icon fas fa-calendar-alt"></i>
                                        <p>Balancesheet Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.generatepayslip')}}" class="nav-link">
                                        <i class="nav-icon fas fa-print"></i>
                                        <p>Generate Payslip</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.payrollreport')}}" class="nav-link">
                                    <i class="nav-icon fas fa-dollar-sign"></i>
                                        <p>Payroll Report</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="configuration1" class="nav-link">
                               <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Site Configuration
                                </p>
                            </a>
                        </li>
                        @else
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-poll"></i>
                                <p>
                                    Report Managment
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.timesheetreport')}}" class="nav-link">
                                        <i class="nav-icon fas fa-calendar-alt"></i>
                                        <p>Timesheet Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.generatepayslip')}}" class="nav-link">
                                        <i class="nav-icon fas fa-print"></i>
                                        <p>Generate Payslip</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('content')

        <footer class="main-footer">
            <strong>&copy; 2021 CRM. All rights reserved. Designed with <i class="fa fa-heart"></i> by <a title="webcreta" target="_blank" href="http://www.webcreta.com"
                rel="noopener noreferrer">Webcreta</a></strong>

            <div class="float-right d-none d-sm-inline-block">
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- <script src="{{asset('/js/edit_add.js')}}"></script>
        <script src="{{asset('/js/dataTables.min.css')}}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
        @stack('scripts')
    <script type="text/javascript" src="{{ asset('DataTables/jquery-3.5.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Datatables/datatables.js') }}"></script>

    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('/js/dataTables.min.js')}}"></script>
</body>
</html>

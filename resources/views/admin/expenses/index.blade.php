@extends('admin.master')
@push('styles')
<style>
    table.dataTable thead th,
    table.dataTable thead td {
        padding: 10px 18px;
        border-top: none;
        border-bottom: 1px solid rgba(33, 33, 33, 0.1);
    }

    table.dataTable.no-footer {
        border-bottom: none;
    }
</style>
@endpush
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Expense Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
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
            </div>
        </div>
    </div>
    <div class="content">
        <section class="col-lg-12 connectedSortable">
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
                    <table id="data" class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Category Name</th>
                                <th>Entry Date</th>
                                <th>Amount(CAD)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        $('#data').DataTable({
             processing:true,
             serverSide:true,
             "order": [[ 0, "desc" ]],
             ajax:"{{ route('admin.getexpenses') }}",
            columns:[
            {data: 'id', name: 'id'},
            {data: 'category', name: 'category'},
            {data: 'entry_date', name: 'entry_date'},
            {data: 'amount', name: 'amount'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
        })
    });
</script>
<script>
    function myFunction() {
  alert("Are you sure want to delete!");
}
</script>
@endpush

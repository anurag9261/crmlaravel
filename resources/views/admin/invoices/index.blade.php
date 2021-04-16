@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Invoice Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Invoices</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-secondary" style="float:right"><a href="{{route('admin.addinvoice')}}"
                                style="color:white"><i class="fas fa-plus">
                                    </i> Add Invoice</a></button>
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
                    <table id="invoices" class="table table-bordered table-striped">
                        <thead>
                            <tr class="" style="background: #6c757d; color: #fff; border-color: #6c757d;">
                                <th>No</th>
                                <th>Title</th>
                                <th>Bill To</th>
                                <th>Due Date</th>
                                <th>Total</th>
                                <th>Status</th>
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
        $('#invoices').DataTable({
             processing:true,
             serverSide:true,
             ajax:"{{ route('admin.getinvoices') }}",
            columns:[
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'bill_to', name: 'bill_to'},
            {data: 'due_date', name: 'due_date'},
            {data: 'total_amount', name: 'total_amount'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
        })
    });
</script>
@endpush

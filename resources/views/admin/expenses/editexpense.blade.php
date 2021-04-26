@extends('admin.master')
@push('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    .files input {
        outline: 2px dashed #92b0b3;
        outline-offset: -10px;
        -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
        transition: outline-offset .15s ease-in-out, background-color .15s linear;
        padding: 30px 0px 85px 35%;
        text-align: center !important;
        margin: 0;
        width: 100% !important;
    }

    .files input:focus {
        outline: 2px dashed #92b0b3;
        outline-offset: -10px;
        -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
        transition: outline-offset .15s ease-in-out, background-color .15s linear;
        border: 1px solid #92b0b3;
    }

    .color input {
        background-color: #f1f1f1;
    }

    .files:before {
        position: absolute;
        bottom: 10px;
        left: 0;
        pointer-events: none;
        width: 100%;
        right: 0;
        height: 40px;
        content: "drag it here. ";
        display: block;
        margin: 0 auto;
        color: black;
        font-weight: 600;
        text-transform: capitalize;
        text-align: center;
    }
</style>
@endpush
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Expense</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Expense Management</li>
                        <li class="breadcrumb-item active">Edit Expense</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-secondary" style="float:right"><a href="{{route('admin.expenses')}}"
                                style="color:white"><i class="fas fa-arrow-left"></i> Back</a></button>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <section class="col-lg-9 connectedSortable">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.updateexpense',[$profile->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <label for="category">Category Name</label>
                                <input type="text" class="form-control @error('category') is-invalid @enderror"
                                    name="category" value="{{$profile->category}}">
                                @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="date">Entry Date</label>
                                <input type="text" id="datepicker4" class="form-control @error('entry_date') is-invalid @enderror"
                                    name="entry_date" value="{{$profile->entry_date}}">
                                @error('entry_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5">
                                <label for="amount">Amount</label>
                                <input type="number" class="form-control @error('amount') is-invalid @enderror"
                                    name="amount" value="{{$profile->amount}}">
                                @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="description">Description</label>
                                <textarea type="description" class="form-control @error('description') is-invalid @enderror"
                                    name="description">{{$profile->description}}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <label>Attach Bill</label>
                                <div class="form-group files color">
                                    <input type="file" name="attach_bill" class="form-control" multiple="">
                                </div>
                            </div>
                            <p style="color:red;font-size:12px">*Bill format must be jpeg,png,jpg,PDF with max-size:5mb.</p>
                        </div>
                        <?php $string = substr($profile->attach_bill, -4);?>
                        @if($string == '.pdf')
                        <div class="row">
                            <div class="row">
                                <div class="col-md-5">
                                    <a href="{{asset('bills/'.$profile->attach_bill)}}" download>
                                    <img src="{{asset('images/profile/pdf1.png')}}" width="80px" , height="auto" ,>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-md-5">
                            <img src="{{asset('bills/'. $profile->attach_bill)}}" width="80px" , height="auto" ,>
                        </div>
                        @endif
                        <br>
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
    $("#datepicker4").datepicker({
        dateFormat: "yy-mm-dd"
    });
});
</script>
@endpush

@extends('admin.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add Invoice</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Add Invoice</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <button class="btn btn-outline-info" style="float:right"><a href="{{route('admin.invoices')}}" style="color:black"><i class="fas fa-arrow-left"></i>Back</a></button>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <!-- Left col -->
        <section class="col-lg-9 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.rolesubmit')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <?php //echo"<pre>"; print_r($roles); die; ?>
                        <div class="row">
                            <div class="col-md-8">
                                <label for="role">Role</label>
                                <select class="form-control  @error('role') is-invalid @enderror" name="role">         
                                        @foreach($admin as $key => $profile)
                                            <option value="{{$key}}">{{$profile->title}}</option> 
                                        @endforeach
                                </select>                      
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{--<div class="row">
                            <div class="col-md-8">
                                <label for="role">Username</label>
                                <select id="role" class="form-control  @error('username') is-invalid @enderror" name="role">         
                                        @foreach($fname as $profile)
                                            <option>{{$profile->fname}}</option> 
                                        @endforeach
                                </select>                      
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>--}}
                        <div class="row">
                            <div class="col-md-8">
                                <label for="username">Username</label>
                                <select id="username" class="form-control @error('username') is-invalid @enderror" name="username">
                                    
                                </select>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
@push('js')
<script type=text/javascript>
  $('#role').change(function(){
  var role = $(this).val();  
  if(role){
    $.ajax({
      type:"GET",
      url:"{{url('get-username-list')}}?fname="+fname,
      success:function(res){        
      if(res){
        $("#username").empty();
        $("#username").append('<option>Select</option>');
        $.each(res,function(key,value){
          $("#username").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#username").empty();
      }
      }
    });
  }else{
    $("#username").empty();
  }   
  });
</script>
@endpush
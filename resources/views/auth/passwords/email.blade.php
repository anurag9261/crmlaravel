@extends('layouts.app')
@section('content')
    <div class="login-form">
        <form action="{{ route('password.email') }}" method="post">
            @csrf     
            <h4 class="modal-title">Reset Password</h4>
            @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            <div class="form-group">
                <input type="email" class="@error('email') is-invalid @enderror form-control"
                    placeholder="Enter Email here" name="email" required="required">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <input type="submit" class="btn btn-primary btn-block btn-lg" value="Send Password Verification Link">
        </form>
    </div>
@endsection
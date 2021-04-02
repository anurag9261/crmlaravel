@extends('layouts.app')
@section('content')
    <div class="login-form">
        <form action="{{ route('password.update') }}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">     
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
            <div class="form-group">
                <input type="password" class="@error('password') is-invalid @enderror form-control"
                    placeholder="Enter Password here" name="password" required="required">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="@error('confirmpassword') is-invalid @enderror form-control"
                    placeholder="Confirm Password here" name="password_confirmation" required="required">
                @error('confirmpassword')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <input type="submit" class="btn btn-primary btn-block btn-lg" value="Reset Password">
        </form>
    </div>
@endsection

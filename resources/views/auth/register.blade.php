@extends('auth.app')
@section('content')
    <h3 class="mb-4">Register as New Applicant</h3>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="row">
            <div class="col-md-12 mb-3">
                <label class="mb-2">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                @error('name')
                <span class="text-warning" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <label class="mb-2">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                @error('email')
                <span class="text-warning" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <label class="mb-2">CNIC#</label>
                <input type="text" class="form-control @error('cnic') is-invalid @enderror cnic" name="cnic" value="{{ old('cnic') }}">
                @error('cnic')
                <span class="text-warning" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <label class="mb-2">WhatsApp Enable Mobile#</label>
                <input type="text" class="form-control @error('mobile') is-invalid @enderror mobile" name="mobile" value="{{ old('mobile') }}">
                @error('mobile')
                <span class="text-warning" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <label class="mb-2">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                @error('password')
                <span class="text-warning" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <label class="mb-2">Confirm Password</label>
                <input id="password" type="password" class="form-control" name="password_confirmation">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-sm btn-success">Register</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <span>Already have an account, Click on <a href="{{route('login')}}" class="text-warning">Login</a></span>
            </div>
        </div>
    </form>
@endsection

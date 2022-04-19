@extends('auth.app')
@section('content')
    <h3 class="mb-4">Reset Password</h3>
    <form method="POST" action="{{ route('password.update') }}">
    @csrf
    <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="col-md-12 mb-3">
            <label class="mb-2">Email</label>
            <input type="email" class="form-control rounded-0 @error('email') is-invalid @enderror" name="email" value="{{isset($request->email)?$request->email:old('email')}}">
            @error('email')
            <span class="text-warning" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-12 mb-3">
            <label class="mb-2">Password</label>
            <input type="password" class="form-control rounded-0 @error('password') is-invalid @enderror" name="password">
            @error('password')
            <span class="text-warning" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="col-md-12 mb-3">
            <label class="mb-2">Confitm Password</label>
            <input type="password" class="form-control rounded-0 @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
            @error('password_confirmation')
            <span class="text-warning" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input type="submit" value="Reset Password" class="btn btn-sm btn-success bg-green waves-effect">
        </div>
    </form>
@endsection


@extends('auth.app')
@section('content')
    <h3 class="mb-4">Login Here</h3>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-group mb-2">
            <span class="input-group-text rounded-0 bg-yellow"><i class="fa fa-user"></i></span>
            <input type="email" class="form-control rounded-0 @error('email') is-invalid @enderror" name="email" value="{{old('email')}}">
        </div>
        <div class="text-left">
            @error('email')
            <span class="text-warning" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="input-group mb-2">
            <span class="input-group-text rounded-0 bg-yellow"><i class="fa fa-key"></i></span>
            <input type="password" class="form-control rounded-0 @error('password') is-invalid @enderror" name="password">
        </div>
        <div class="text-left">
            @error('email')
            <span class="text-warning" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Remember me
            </label>
        </div>
        <div class="input-group mb-3">
            <input type="submit" value="Login" class="btn btn-sm btn-success bg-green waves-effect">
        </div>
    </form>
   {{-- <div class="input-group">
       <span>Want to create a new account? <a href="{{route('register')}}" class="mx-1 text-warning">Sign Up</a> here</span>
   </div>
    <div class="input-group">
        @if (Route::has('password.request'))
            Forgot password? <a class="mx-1 text-warning" href="{{ route('password.request') }}">Password Reset</a> here
        @endif
    </div> --}}
@endsection

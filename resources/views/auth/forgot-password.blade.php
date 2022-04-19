@extends('auth.app')
@section('content')
    <h3 class="mb-4">Forgot Password</h3>
    <form method="POST" action="{{ route('password.email') }}">
    @csrf
        <div class="col-md-12 mb-3">
            <label class="mb-2">Email</label>
            <input type="email" class="form-control rounded-0 @error('email') is-invalid @enderror" name="email" value="{{old('email')}}">
            @error('email')
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


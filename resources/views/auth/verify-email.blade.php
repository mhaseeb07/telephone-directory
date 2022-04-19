@extends('auth.app')
@section('content')
    <h3 class="mb-4">Send Verification Email</h3>
    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif
    <div class="d-flex">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <input type="submit" value="Send Link" class="btn btn-sm btn-success bg-green waves-effect">
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <input type="submit" value="Logout" class="btn btn-sm btn-danger waves-effect">
        </form>
    </div>
@endsection


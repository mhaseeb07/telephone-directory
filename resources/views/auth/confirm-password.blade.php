@extends('auth.app')
@section('content')
    <form method="POST" action="{{ route('password.confirm') }}">
    @csrf<!-- Password -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <label class="mb-2">Password</label>
                <input id="password" type="password" class="form-control rounded-0" name="password">
            </div>
            <div class="input-group mb-3">
                <input type="submit" value="Confirm" class="btn btn-sm btn-success bg-green waves-effect">
            </div>
        </div>
    </form>
@endsection

@extends('admin.layouts.app')
@section('title','Add New')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between py-4">
            <p class="page-title">Add New</p>
            <a class="btn btn-sm btn-warning" href="{{route('user.index')}}">View All</a>
        </div>
        <div class="card rounded-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('user.store')}}" method="post">
                            @csrf
                            <input type="hidden" class="form-control" name="role_status" value="1">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Full Name *</label>
                                    <input type="text" class="form-control rounded-0" name="name" value="{{old('name')}}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="email" class="form-control rounded-0" name="email" value="{{old('email')}}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Assign Role</label>
                                    <select class="form-control rounded-0" name="roles">
                                        <option value="">Please Select</option>
                                        @if(count($roles))
                                            @foreach($roles as $role)
                                                <option value="{{$role}}">{{$role}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control rounded-0" name="password">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control rounded-0" name="password_confirmation">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <input type="submit" class="btn btn-sm btn-success" value="Add New">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush

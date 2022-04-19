@extends('admin.layouts.app')
@section('title','Show')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between py-4">
            <p class="page-title">Show</p>
            <a class="btn btn-sm btn-warning" href="{{route('role.index')}}">View All</a>
        </div>
        <div class="card rounded-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Role Name: </label>
                                <label>{{(isset($role->name))?$role->name:old('name')}}</label>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="row">
                                    @foreach($role->permissions as $per)
                                            <div class="col-3 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input disabled" type="checkbox"  name="permission[]" value="{{$per->id}}" checked>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        {{ $per->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush

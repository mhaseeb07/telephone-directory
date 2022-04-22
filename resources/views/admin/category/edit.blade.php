@extends('admin.layouts.app')
@section('title','Add New')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between py-4">
            <p class="page-title">Edit</p>
            <a class="btn btn-sm btn-warning" href="{{route('category.create')}}">View All</a>
        </div>
        <div class="card rounded-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('category.update',$g_Category->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label class="form-label">Category *</label>
                                    <input type="text" placeholder="Enter Category" class="form-control rounded-0" name="name" value="{{$g_Category->name}}">
                                </div>
                                <div class="col-md-12 mb-3 text-right">
                                    <input type="submit" class="btn btn-sm btn-success" value="Update">
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

@extends('admin.layouts.app')
@section('title','Add New')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between py-4">
            <p class="page-title">Edit</p>
            <a class="btn btn-sm btn-warning" href="{{route('contact-info.index')}}">View All</a>
        </div>
        <div class="card rounded-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('contact-info.update', $g_Contact->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label class="form-label">Name *</label>
                                    <input type="text" placeholder="Enter Name" class="form-control rounded-0" name="name" value="{{$g_Contact->name}}">
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label class="form-label">Designation *</label>
                                    <input type="text" placeholder="Enter Designation" class="form-control rounded-0" name="designation" value="{{$g_Contact->designation}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label class="form-label">Company *</label>
                                    <input type="text" placeholder="Enter Company" class="form-control rounded-0" name="company" value="{{$g_Contact->company}}">
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label class="form-label">Business Phone *</label>
                                    <input type="text" placeholder="Enter Business Phon" class="form-control rounded-0" name="business_phone" value="{{$g_Contact->business_phone}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label class="form-label">Department *</label>
                                    <select class="form-select form-control" id="select" name="dpt_id" data-placeholder="Please Select Department" id="dpt_id" value="{{$g_Contact->dpt_id}}">
                                        <option></option>
                                        @foreach($g_Department as $dpt)
                                            <option value="{{$dpt->id}}" {{ $dpt->id == $g_Contact->dpt_id ? 'selected' : '' }}>{{$dpt->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label class="form-label">City *</label>
                                    <input type="text" placeholder="Enter Department Name" class="form-control rounded-0" name="city" value="{{$g_Contact->city}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label class="form-label">Factory Phone *</label>
                                    <input type="text" placeholder="Enter Factory Phone" class="form-control rounded-0" name="factory_phone" value="{{$g_Contact->factory_phone}}">
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label class="form-label">Home Phone *</label>
                                    <input type="text" placeholder="Enter Home Phone" class="form-control rounded-0" name="home_phone" value="{{$g_Contact->home_phone}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label class="form-label">Fax No *</label>
                                    <input type="text" placeholder="Enter Fax No" class="form-control rounded-0" name="fax_no" value="{{$g_Contact->fax_no}}">
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label class="form-label">Mobile No *</label>
                                    <input type="text" placeholder="Enter Mobile No" class="form-control rounded-0" name="mobile_no" value="{{$g_Contact->mobile_no}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="text" placeholder="Enter Email" class="form-control rounded-0" name="email" value="{{$g_Contact->email}}">
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label class="form-label">Web Site *</label>
                                    <input type="text" placeholder="Enter Web Site" class="form-control rounded-0" name="website" value="{{$g_Contact->website}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <label class="form-label">Address *</label>
                                    <input type="text" placeholder="Enter Address" class="form-control rounded-0" name="address" value="{{$g_Contact->address}}">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 text-right">
                                <input type="submit" class="btn btn-sm btn-success" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
    $(".form-select").select2({
    });
</script>
@endpush

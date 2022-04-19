@extends('admin.layouts.app')
@section('title','Groups')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between py-4">
            <p class="page-title">Groups</p>
            <a class="btn btn-sm btn-success" href="{{route('permission_group.create')}}">Add New</a>
        </div>
        <div class="card rounded-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-sm dataTable">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groups as $group)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$group->name}}</td>
                                <td>
                                    <a href="{{route('permission_group.edit',$group->id)}}" class="btn btn-sm btn-warning mx-2"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function (){
            var t = $('.dataTable').DataTable({
                processing: false,
                serverSide: false
            });
        });
    </script>
@endpush

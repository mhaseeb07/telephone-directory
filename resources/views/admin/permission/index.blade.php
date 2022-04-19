@extends('admin.layouts.app')
@section('title','Permissions')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between py-4">
            <p class="page-title">Permissions</p>
            <a class="btn btn-sm btn-success" href="{{route('permission.create')}}">Add New</a>
        </div>
        <div class="card rounded-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-sm dataTable">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Group Name</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$permission->p_name}}</td>
                                <td>{{$permission->g_name}}</td>
                                <td>
                                    <a href="{{route('permission.edit',$permission->p_id)}}" class="btn btn-sm btn-warning mx-2"><i class="fa fa-edit"></i></a>
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

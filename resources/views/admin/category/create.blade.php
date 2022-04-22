@extends('admin.layouts.app')
@section('title','Add New')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between py-4">
        <p class="page-title">Add New</p>
        <a class="btn btn-sm btn-warning" href="{{route('category.create')}}">View All</a>
    </div>
    <div class="card rounded-0">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-3">
                                <label class="form-label">Category*</label>
                                <input type="text" placeholder="Enter Category" class="form-control rounded-0" name="name" value="{{old('name')}}">
                            </div>
                            <div class="col-md-12 mb-3 text-right">
                                <input type="submit" class="btn btn-sm btn-success" value="Create">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="d-flex justify-content-between py-4">
        <p class="page-title">Category</p>
        <a class="btn btn-sm btn-success" href="{{route('category.create')}}">Add New</a>
    </div>
    <div class="card rounded-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm dataTable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>                      
                        <th scope="col">Slug</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Updated By</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
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
            processing: true,
            serverSide: true,
            order:[[0,'desc']],
            ajax: "{{route('getCategory')}}",
            columns: [
                { data: 'id',orderable:false },
                { data: 'name' },
                { data: 'slug' },
                { data: 'created_by' },
                { data: 'updated_by' },
                { data: null}
            ],
            columnDefs: [
                {
                    render: function ( data, type, row,meta ) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    searchable:false,
                    orderable:true,
                    targets: 0
                },{
                    render: function (data,type,row,meta) {
                        var edit ='{{ route("category.edit", ":id") }}';
                        edit = edit.replace(':id', data.id);
                        var del ='{{ route("category.delete", ":id") }}';
                        del = del.replace(':id', data.id);
                        var sdel ='{{ route("category.destroy", ":id") }}';
                        sdel = sdel.replace(':id', data.id);
                        var restore ='{{ route("category.restore", ":id") }}';
                        restore = restore.replace(':id', data.id);

                            if(data.deleted_at == '1'){
                            return '<div class="d-flex">' +
                                    @can('category-restore')
                                        '<a href="'+restore+'" class="btn btn-sm btn-warning mx-2">restore</a>'+
                                    @endcan
                                    @can('category-delete')
                                        '<form action="'+del+'" method="POST">'+
                                        '<input type="hidden" name="_token" value="{{ csrf_token() }}">'+
                                        '<input type="hidden" name="_method" value="delete" />'+
                                        '<button type="submit" class="btn btn-sm btn-danger mx-2" onclick="return confirm(`Are you sure?`)"><i class="fa fa-trash"></i></button>'+
                                        '</form>'+
                                    @endcan
                                '</div>';
                            }
                            if(data.deleted_at == '0'){
                                return '<div class="d-flex">' +
                                    @can('category-edit')
                                        '<a href="'+edit+'" class="btn btn-sm btn-warning mx-2"><i class="fa fa-edit"></i></a>'+
                                    @endcan
                                    @can('category-softdelete')
                                        '<form action="'+sdel+'" method="POST">'+
                                        '<input type="hidden" name="_token" value="{{ csrf_token() }}">'+
                                        '<input type="hidden" name="_method" value="delete" />'+
                                        '<button type="submit" class="btn btn-sm btn-danger mx-2" onclick="return confirm(Are you sure?)"><i class="fa fa-trash"></i></button>'+
                                        '</form>'+
                                    @endcan
                                '</div>';
                            }
                    },
                    searchable:false,
                    orderable:false,
                    targets: -1
                }
            ]
        });
    });
</script>
@endpush

@extends('admin.layouts.app')
@section('title','Add New')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between py-4">
        <p class="page-title">Contact Information</p>
        <a class="btn btn-sm btn-success" href="{{route('contact-info.create')}}">Add New</a>
    </div>
    <div class="card rounded-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm dataTable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>     
                        <th scope="col">Department</th>                 
                        <th scope="col">Designation</th>
                        <th scope="col">City</th>
                        <th scope="col">Company</th>
                        <th scope="col">Mobile No</th>
                        <th scope="col">Business Phone</th>
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
            ajax: "{{route('getContactInfo')}}",
            columns: [
                { data: 'id',orderable:false },
                { data: 'name' },
                { data: 'dpt_id' },
                { data: 'designation' },
                { data: 'city' },
                { data: 'company' },
                { data: 'mobile_no' },
                { data: 'business_phone' },
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
                        var edit ='{{ route("contact-info.edit", ":id") }}';
                        edit = edit.replace(':id', data.id);
                        var del ='{{ route("contact-info.delete", ":id") }}';
                        del = del.replace(':id', data.id);
                        var sdel ='{{ route("contact-info.destroy", ":id") }}';
                        sdel = sdel.replace(':id', data.id);
                        var restore ='{{ route("contact-info.restore", ":id") }}';
                        restore = restore.replace(':id', data.id);

                            if(data.deleted_at == '1'){
                            return '<div class="d-flex">' +
                                    @can('contact-info-restore')
                                        '<a href="'+restore+'" class="btn btn-sm btn-warning mx-2">restore</a>'+
                                    @endcan
                                    @can('contact-info-delete')
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
                                    @can('contact-info-edit')
                                        '<a href="'+edit+'" class="btn btn-sm btn-warning mx-2"><i class="fa fa-edit"></i></a>'+
                                    @endcan
                                    @can('contact-info-softdelete')
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

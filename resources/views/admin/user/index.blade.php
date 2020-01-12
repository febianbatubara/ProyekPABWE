@extends('admin.templates.default')

@section('content')


<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data User</h3>
    </div>

    <div class="box-body">

        @include('admin.templates.partials.alerts')

    <table id="dataTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tanggal Verifikasi Email</th>
                </tr>
            </thead>
            
    </table>
    </div>
</div>

<!-- <form action="" method="post" id="deleteForm">
    @csrf
    @method('DELETE')
    <input type="submit" value="Hapus"  style="display:none">
</form> -->

@push('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

@endpush

@endsection

@push('scripts')
    <!-- DataTables -->
    <script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(function (){ 
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.user.data') }}',
                columns:[

                    { data: 'DT_RowIndex',orderable:false, searchable:false},
                    { data: 'name'},
                    { data: 'email'},
                    { data: 'email_verified_at'},
                ]
            });
        });
    </script>
@endpush
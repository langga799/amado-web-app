@extends('_layouts.app')

@section('title', 'Data Pasien')

@section('content')

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <span>{{ session('success') }}</span>
            <button class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div id="alert"></div>

    <div class="card shadow">
        <div class="card-header py-2 d-flex justify-content-between align-items-center">
            <h2 class="h6 m-0 font-weight-bold text-primary">Data Pasien</h2>
            <a href="{{ route('patient.create') }}" class="btn btn-sm btn-primary shadow">Tambah Pasien</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('sbadmin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        const ajaxUrl = '{{ route('patient.datatables') }}'
        const deleteUrl = '{{ route('patient.destroy', ':id') }}'
        const csrf = '{{ csrf_token() }}'

    </script>

    <script src="{{ asset('js/patient.js') }}"></script>
@endpush

@extends('layouts.master')

@push('css')
    @include('layouts.extra.css.datatables')
    @include('layouts.extra.css.select2')
@endpush
@push('actions_top')
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
                  <span class="d-none d-sm-inline">
                    <a href="#" class="btn">
                      New view
                    </a>
                  </span>
            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-create_role">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                Create Role
            </a>
            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
            </a>
        </div>
    </div>
@endpush
@include('pages.roles.models.create')
@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
            <div class="card-header">
                <h3 class="card-title">La list des rôles</h3>
            </div>
            <div class="table-responsive">
            <table class="table table-striped" style="width:100%" id="roles_table">
                <thead >
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>Created</th>
                    <th class="w-1"></th>
                </tr>
                </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
            </div>
        </div>
    </div>
@endsection
@push('js')

    @include('layouts.extra.js.datatables')
    <script>
        $('#roles_table').DataTable( {
            responsive: true,
            processing: true,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            ajax: {
                url: '/roles/',
            },
            columns: [
                // {data: 'responsive', className: 'responsive'},
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'created_at', name: 'created_at'},
                {data: 'actions', name: 'actions'},
            ],
        });

    </script>

    @include('layouts.extra.js.select2')
    <script>
        $( '#permissions' ).select2( {
            theme: 'bootstrap-5',
            placeholder:'selectionez les permissions'
        } );
    </script>

@endpush

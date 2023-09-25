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
@section('content')

    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">La Liste des utilisateurs</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" style="width:100%" id="users_table">
                            <thead >
                            <tr>
                                <th>ID</th>
                                <th>Nom d'utilisateur</th>
                                <th>Numéro de téléphone</th>
                                <th>Les rôles</th>
                                <th>Statut</th>
                                <th>Créé à</th>
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
        $('#users_table').DataTable({
            responsive:true,
            processing:true,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            ajax:{
                url:'/users/',
            },
            columns:[
                {data:'id',name:'id'},
                {data:'username',name:'username'},
                {data:'phone_number',name:'phone_number'},
                {data:'role_name',render:function (data) {
                        if (data.length==0)
                            return  'Aucun rôle'
                        if (data.length=1)
                            return data[0]
                        else {
                             d=''
                            for ( i=0; i<data.length;i++){
                              d=data[i]+','
                            }
                            return d
                        }

                    }},
                {data:'status',render:function (data){
                    return data ? '<label class="badge bg-teal ms-2">Activer</label>' : '<label class="badge bg-red ms-2">Désactiver</label>';
                }},
                {data:'created_at',name:'created_at'},
                {data:'actions',name:'actions'},


            ],
        })
    </script>
@endpush

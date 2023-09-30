@extends('layouts.master')

@push('css')
    @include('layouts.extra.css.datatables')
    @include('layouts.extra.css.select2')
    <style>
        a {
            position: relative;
            display: inline-block;
        }

        a[data-title]::after {
            content: attr(data-title);
            background-color: #e13131;
            color: black;
            font-size: 1.2em;
            position: absolute;
            padding: 1px 5px 2px 5px;
            bottom: 1.1em;
            left: 50%;
            white-space: nowrap;
            box-shadow: 1px 1px 4px #242424;
            opacity: 0;
            border: 1px solid #1b1b1b;
            z-index: 9999999;
            visibility: hidden;
        }

        a[data-title]:hover::after {
            visibility: visible;
            opacity: 1;
            transition: all 0.1s ease 0.4s;
        }
    </style>
    </style>
@endpush

@push('actions_top')
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <a href="{{route('users.create')}}" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-create_residence">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                Ajouter une nouvelle résidence
            </a>
        </div>
    </div>

@endpush
@include('pages.residences.models.create')
@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">La Liste des résidences</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" style="width:100%" id="residence_table">
                            <thead >
                            <tr>
                                <th>ID</th>
                                <th>Nom de résidence</th>
                                <th>Propriétaire de résidence</th>
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
        $('#residence_table').DataTable({
            responsive:true,
            processing:true,
            language:{"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"},
            ajax:{
                url:'/residences/',
            },
            columns:[
                {data:'id',name:'id'},
                {data:'name',name:'name'},
                {data:'user_residence',render:function (data) {
                   return data.first_name +' '+data.last_name
                }},
                {data:'created_at',name:'created_at'},
                {data:'actions',name: 'actions'}
            ],
        })
    </script>
    @include('layouts.extra.js.select2')
    <script>
        $( '#users' ).select2( {
            theme: 'bootstrap-5',
            placeholder:'selectionez les permissions'
        } );
    </script>



@endpush

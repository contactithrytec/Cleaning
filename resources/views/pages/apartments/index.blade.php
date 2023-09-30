@push('css')
    @include('layouts.extra.css.datatables')
    @include('layouts.extra.css.select2')
@endpush


    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">La Liste des appartements</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" style="width:100%" id="apartments_table">
                            <thead >
                            <tr>
                                <th>ID</th>
                               {{-- <th>Résidence de l'appartement</th>--}}
                                <th>Numéro de l'appartement</th>
                                <th>Nom de l'appartement</th>
                                <th>Type de l'appartement</th>
                                <th>Prioritaire</th>
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

@push('js')
    @include('layouts.extra.js.datatables')
    <script>
        $('#apartments_table').DataTable({
            responsive:true,
            processing:true,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            ajax:{
                url:'/apartments/',
            },
            columns:[
                {data:'id',name:'id'},
                {data:'num',name:'num'},
                {data:'name',name:'name'},
                {data:'type_apartment',render:function (data) {
                        return data.name
                    }},
                {data:'priopity',render:function (data){
                        return data ? '<label class="badge bg-teal ms-2">Oui</label>' : '<label class="badge bg-red ms-2">Non</label>';
                    }},

                /*{data:'residence_apartment',render:function (data) {
                        return data.name
                    }},*/
                {data:'status',render:function (data){
                        return data ? '<label class="badge bg-teal ms-2">Activer</label>' : '<label class="badge bg-red ms-2">Désactiver</label>';
                    }},
                {data:'created_at',name:'created_at'},
                {data:'actions',name:'actions'},


            ],
        })
    </script>
@endpush

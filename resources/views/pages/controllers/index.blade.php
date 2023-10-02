@push('css')
    @include('layouts.extra.css.datatables')
    @include('layouts.extra.css.select2')
@endpush


    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">La Liste des Controlleur</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" style="width:100%" id="controllers_table">
                            <thead >
                            <tr>
                                <th>ID</th>
                                <th>Nom de controlleur</th>
                                <th>Numéro de téléphone</th>
                                <th>Le rôle</th>
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
        $('#controllers_table').DataTable({
            responsive:true,
            processing:true,
            language: {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            ajax:{
                url:'/controllers?where=' + JSON.stringify({
                    "where": [
                        {
                            'residence_id': "{{$residence->id}}"
                        }
                    ]
                })
            },
            columns:[
                {data:'id',name:'id'},
                {data:'full_name',name:'full_name'},
                {data:'phone_number',name:'phone_number'},
                {data:'role_name',render:function (data) {
                        if (data.length==0)
                            return  'Aucun rôle'
                        else  (data.length=1)
                            return data[0]
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

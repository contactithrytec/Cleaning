@extends('layouts.master')

@push('css')
@endpush

@push('actions_top')
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <a href="{{route('controllers.create',$residence->id)}}" class="btn btn-primary d-none d-sm-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                Ajouter un nouveau contrôleur
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
                            <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs">
                                <li class="nav-item">
                                    <a href="#tabs-detail" class="nav-link active" data-bs-toggle="tab" id="infos">Informations sur la résidence</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tabs-controllers" class="nav-link" data-bs-toggle="tab" id="list_controllers">La liste des controlleurs de la résidence</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="tabs-detail">
                                    <h4>Informations sur la résidence</h4>
                                    <div>
                                        <div class="mb-4">
                                            <label class="form-label">Nom de résidence</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="entrez le nom de la résidence" value="{{$residence->name}}" disabled>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label">Propriétaire de résidence</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="entrez le nom de la résidence" value="{{$residence->UserResidence['first_name'].' '.$residence->UserResidence['last_name']}}" disabled>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label">Date de création</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="entrez le nom de la résidence" value="{{$residence->created_at}}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-controllers">
                                    @include('pages.controllers.index',['residence_id'=>$residence->id])
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        var url = window.location.href;
        var activeTab = url.substring(url.indexOf("#") + 1);
        var tabs=[
            'tabs-detail',
            'tabs-controllers'
        ];
        console.log(activeTab);
        if(tabs.includes(activeTab)){
            $('#tabs-detail').removeClass('active');
            $('#tabs-detail').removeClass('show');
            $('#infos').removeClass('active');

            $('#tabs-controllers').addClass('active');
            $('#tabs-controllers').addClass('show');
            $('#list_controllers').addClass('active');
        }

    </script>
@endpush

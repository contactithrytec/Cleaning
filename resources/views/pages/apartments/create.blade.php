@extends('layouts.master')

@push('css')
    @include('layouts.extra.css.select2')
@endpush

@section('content')

    <div class="container-xl">
        <form action="{{route('apartments.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="row g-0">
                    <div class="col d-flex flex-column">
                        <div class="card-body">
                            <h2 class="mb-4"> Ajouter un nouvel appartement</h2>
                            <div class="row g-3">
                                <div class="col-md">
                                    <div class="form-label">Nom de l'appartement</div>
                                    <input type="text" class="form-control" name="name" id="name" value="" placeholder="entrez le nom de l'appartement" Required>
                                </div>
                                <div class="col-md">
                                    <div class="form-label Required">Numéro de l'appartement</div>
                                    <input type="text" class="form-control" name="num" id="num" value="" placeholder="entrez le numéro de l'appartement" Required>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <div class="form-label mt-4">Notes sur l'appartement</div>
                                    <textarea class="form-control" name="note" id="note"  placeholder="entrez des notes sur l'appartement" Required></textarea>
                                </div>
                            </div>
                            <div class="row g-3 mt-4">
                                <div class="col-md">
                                    <div class="form-label Required ">Prioritaire</div>
                                    <select class="form-control" value="" name="priority" id="priority" placeholder="entrez l'adresse">
                                        <option value="" disabled selected hidden>Sélectionnez oui si l'appartement est prioritaire</option>
                                        <option value="1">Oui</option>
                                        <option value="0">Non</option>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <div class="form-label Required ">Status</div>
                                    <select class="form-control" value="" name="status" id="status" placeholder="entrez l'adresse">
                                        <option value="" disabled selected hidden>Sélectionnez le statut de l'appartement</option>
                                        <option value="1">Oui</option>
                                        <option value="0">Non</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 mt-4">
                                <div class="col-md">
                                    <div class="form-label Required ">Type de nettoyage</div>
                                    <select class="form-select" id="type_id" name="type_id" data-placeholder="Sélectionnez le type de nettoyage" multiple required>
                                        <option></option>
                                        @if(isset($types))
                                            @foreach($types as $type)
                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" name="residence_id" id="residence_id" value="{{$residence->id}}">
                            <input type="hidden" name="redirect_url" id="redirect_url" value="{{route('residences.show',$residence->id)}}">

                            {{-- <h3 class="card-title mt-4">Status</h3>
                             <p class="card-subtitle">Rendre le profil activé signifie que l'utilisateur peut accéder à son profil.</p>
                             <div>
                                 <label class="form-check form-switch form-switch-lg Required">
                                     <input class="form-check-input" type="checkbox" name="status" id="status" >
                                     <span class="form-check-label form-check-label-on">l'utilisateur est actuellement activé</span>
                                     <span class="form-check-label form-check-label-off">l'utilisateur est actuellement désactivé</span>
                                 </label>
                             </div>--}}
                        </div>
                        <input type="hidden" value="0" id="from_residence" name="from_residence">
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    Ajouter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection

@push('js')

    @include('layouts.extra.js.select2')

    <script>
        $( '#type_id' ).select2( {
            theme: 'bootstrap-5',
            placeholder:'selectionez les permissions'
        } );

        var url = window.location.href;
        console.log(url)
        var activeTab = url.substring(url.indexOf("=") + 1);

        if(activeTab==1)
            document.getElementById('from_residence').value=activeTab;

    </script>

@endpush




